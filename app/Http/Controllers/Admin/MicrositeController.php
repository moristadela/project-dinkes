<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microsite;
use App\Models\Bidang;
use App\Models\Seksi;
use App\Models\DaftarLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MicrositeController extends Controller
{
    /**
     * Tampilkan daftar microsite
     */
    public function index()
    {
        // Memuat microsite dengan link terkait untuk ditampilkan
        $microsites = Microsite::with('links')->latest()->get();
        return view('admin.microsites.index', compact('microsites'));
    }

    /**
     * Form tambah microsite
     */
    public function create()
    {
        // Mengambil semua data Bidang dan Seksi yang terkait
        $allBidang = Bidang::with('seksi')->get();
        // Mengirimkan data ke view
        return view('admin.microsites.create', compact('allBidang'));
    }

    /**
     * Simpan microsite baru dan link-link-nya
     */
    public function store(Request $request)
    {
        $request->validate([
            'shortlink' => 'required|string|max:255|unique:microsites,shortlink',
            'title'     => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
            'seksi_id'  => 'required|exists:seksi,id',
            'links'     => 'nullable|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url'   => 'required|url',
        ]);
        
        DB::transaction(function () use ($request) {
            // Menyimpan data microsite
            $microsite = Microsite::create([
                'shortlink' => $request->shortlink,
                'title'     => $request->title,
                'bidang_id' => $request->bidang_id,
                'seksi_id'  => $request->seksi_id,
            ]);

            // Menyimpan setiap link ke tabel daftar_link dan mengaitkannya dengan microsite baru
            if ($request->has('links')) {
                foreach ($request->links as $linkData) {
                    $microsite->links()->create([
                        'title'         => $linkData['title'],
                        'original_link' => $linkData['url'],
                        'shortlink'     => Str::random(7),
                    ]);
                }
            }
        });

        return redirect()->route('admin.microsites.index')
                         ->with('success', 'Microsite berhasil dibuat.');
    }

    /**
     * Form edit microsite
     */
    public function edit(Microsite $microsite)
    {
        // Memuat link terkait saat mengedit
        $microsite->load('links');
        // Mengambil semua data Bidang dan Seksi yang terkait
        $allBidang = Bidang::with('seksi')->get();
        return view('admin.microsites.edit', compact('microsite', 'allBidang'));
    }

    /**
     * Update microsite
     */
    public function update(Request $request, Microsite $microsite)
    {
        $request->validate([
            'shortlink' => 'required|unique:microsites,shortlink,' . $microsite->id,
            'title'     => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
            'seksi_id'  => 'required|exists:seksi,id',
            'links'     => 'nullable|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url'   => 'required|url',
            'links.*.id'    => 'nullable|exists:daftar_link,id', // Validasi ID link
        ]);

        DB::transaction(function () use ($request, $microsite) {
            // Update data microsite
            $microsite->update([
                'shortlink' => $request->shortlink,
                'title'     => $request->title,
                'bidang_id' => $request->bidang_id,
                'seksi_id'  => $request->seksi_id,
            ]);

            $existingLinkIds = $microsite->links->pluck('id')->toArray();
            $updatedLinkIds = collect($request->links)->pluck('id')->filter()->toArray();

            // Hapus link yang tidak ada lagi di form
            $linksToDelete = array_diff($existingLinkIds, $updatedLinkIds);
            DaftarLink::destroy($linksToDelete);

            // Perbarui atau tambahkan link baru
            if ($request->has('links')) {
                foreach ($request->links as $linkData) {
                    if (isset($linkData['id'])) {
                        // Perbarui link yang sudah ada
                        $link = DaftarLink::find($linkData['id']);
                        if ($link) {
                            $link->update([
                                'title'         => $linkData['title'],
                                'original_link' => $linkData['url'],
                            ]);
                        }
                    } else {
                        // Tambahkan link baru
                        $microsite->links()->create([
                            'title'         => $linkData['title'],
                            'original_link' => $linkData['url'],
                            'shortlink'     => Str::random(7),
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.microsites.index')
                         ->with('success', 'Microsite berhasil diperbarui.');
    }

    /**
     * Hapus microsite
     */
    public function destroy(Microsite $microsite)
    {
        // Penghapusan microsite akan menghapus link terkait secara otomatis (cascade delete)
        $microsite->delete();

        return redirect()->route('admin.microsites.index')
                         ->with('success', 'Microsite berhasil dihapus.');
    }
    
    /**
     * Tampilkan microsite berdasarkan shortlink
     * Metode ini harus berada di controller yang terpisah dari Admin
     */
    public function show($shortlink)
    {
        // Memuat microsite dan link-link-nya
        $microsite = Microsite::where('shortlink', $shortlink)->firstOrFail();
        $microsite->load('links');
        return view('microsite.show', compact('microsite'));
    }
}
