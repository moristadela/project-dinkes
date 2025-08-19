<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seksi;
use App\Models\Bidang; // Import model Bidang
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str untuk generate string acak

class SeksiController extends Controller {
    public function index() {
        $seksis = Seksi::with('bidang')->latest()->paginate(10);
        return view('admin.seksi.index', compact('seksi'));
    }

    public function create() {
        $bidangs = Bidang::orderBy('nama_bidang')->get(); // Ambil semua bidang untuk dropdown
        return view('admin.seksi.create', compact('bidang'));
    }

    public function store(Request $request) {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'nama_seksi' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['shortlink_code'] = Str::random(6); // Generate kode unik 6 karakter

        Seksi::create($data);

        return redirect()->route('admin.seksi.index')->with('success', 'Seksi/Shortlink berhasil dibuat.');
    }

    public function edit(Seksi $seksi) {
        $bidangs = Bidang::orderBy('nama_bidang')->get();
        return view('admin.seksi.edit', compact('seksi', 'bidang'));
    }

    public function update(Request $request, Seksi $seksi) {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'nama_seksi' => 'required|string|max:255',
        ]);

        $seksi->update($request->all());

        return redirect()->route('admin.seksi.index')->with('success', 'Seksi/Shortlink berhasil diperbarui.');
    }

    public function destroy(Seksi $seksi) {
        $seksi->delete();
        return redirect()->route('admin.seksi.index')->with('success', 'Seksi/Shortlink berhasil dihapus.');
    }
}