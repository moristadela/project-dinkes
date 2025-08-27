<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microsite;
use App\Models\Bidang;
use App\Models\Seksi;
use App\Models\DaftarLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'bidang'    => 'required|exists:bidangs,id',
            'seksi'     => 'required|exists:seksis,id',
            'links'     => 'nullable|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url'   => 'required|url',
        ]);
        
        // Mengambil nama bidang dan seksi berdasarkan ID yang dikirimkan
        $bidang = Bidang::find($request->bidang)->nama_bidang;
        $seksi = Seksi::find($request->seksi)->nama_seksi;

        DB::transaction(function () use ($request, $bidang, $seksi) {
            // Menyimpan data microsite tanpa link terlebih dahulu
            $microsite = Microsite::create([
                'shortlink' => $request->shortlink,
                'title'     => $request->title,
                'bidang'    => $bidang,
                'seksi'     => $seksi,
            ]);

            // Menyimpan setiap link ke tabel daftar_link dan mengaitkannya dengan microsite baru
            if ($request->has('links')) {
                foreach ($request->links as $linkData) {
                    $microsite->links()->create([
                        'title'         => $linkData['title'],
                        'original_link' => $linkData['url'], // Menggunakan 'original_link' sesuai skema DB
                        'shortlink'     => $microsite->shortlink . '-' . uniqid(), // Membuat shortlink unik
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
            'bidang'    => 'required|exists:bidang,id',
            'seksi'     => 'required|exists:seksi,id',
            'links'     => 'nullable|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url'   => 'required|url',
            'links.*.id'    => 'nullable|exists:daftar_link,id', // Validasi ID link
        ]);

        $bidang = Bidang::find($request->bidang)->nama_bidang;
        $seksi = Seksi::find($request->seksi)->nama_seksi;

        DB::transaction(function () use ($request, $microsite, $bidang, $seksi) {
            // Update data microsite
            $microsite->update([
                'shortlink' => $request->shortlink,
                'title'     => $request->title,
                'bidang'    => $bidang,
                'seksi'     => $seksi,
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
                            'shortlink'     => $microsite->shortlink . '-' . uniqid(),
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
        return view('microsites.show', compact('microsite'));
    }
}
