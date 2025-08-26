<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microsite;
use App\Models\Bidang;
use App\Models\Seksi;
use Illuminate\Http\Request;

class MicrositeController extends Controller
{
    /**
     * Tampilkan daftar microsite
     */
    public function index()
    {
        $microsites = Microsite::latest()->get();
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
     * Simpan microsite baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'shortlink' => 'required|unique:microsites,shortlink',
            'title'     => 'required|string|max:255',
            'bidang'    => 'required|exists:bidangs,id',
            'seksi'     => 'required|exists:seksis,id',
            'links'     => 'nullable|array',
            'links.*.title' => 'required|string|max:255',
            'links.*.url' => 'required|url',
        ]);
        
        // Mengambil nama bidang dan seksi berdasarkan ID yang dikirimkan
        $bidang = Bidang::find($request->bidang)->nama_bidang;
        $seksi = Seksi::find($request->seksi)->nama_seksi;

        // Menyimpan data microsite
        Microsite::create([
            'shortlink' => $request->shortlink,
            'title'     => $request->title,
            'bidang'    => $bidang,
            'seksi'     => $seksi,
            'links'     => json_encode($request->links)
        ]);

        return redirect()->route('admin.microsites.index')
                        ->with('success', 'Microsite berhasil dibuat.');
    }

    /**
     * Form edit microsite
     */
    public function edit(Microsite $microsite)
    {
        return view('admin.microsites.edit', compact('microsite'));
    }

    /**
     * Update microsite
     */
    public function update(Request $request, Microsite $microsite)
    {
        $request->validate([
            'shortlink' => 'required|unique:microsites,shortlink,' . $microsite->id,
            'title'     => 'required|string|max:255',
            'bidang'    => 'required|string|max:255',
            'seksi'     => 'required|string|max:255',
        ]);

        $microsite->update($request->all());

        return redirect()->route('admin.microsites.index')
                        ->with('success', 'Microsite berhasil diperbarui.');
    }

    /**
     * Hapus microsite
     */
    public function destroy(Microsite $microsite)
    {
        $microsite->delete();

        return redirect()->route('admin.microsites.index')
                        ->with('success', 'Microsite berhasil dihapus.');
    }
}
