<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seksi;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SeksiController extends Controller
{
    public function index()
    {
        $seksi = Seksi::all();
        return view('admin.seksi.index', compact('seksi'));
    }

    public function create()
    {
        $bidang = Bidang::orderBy('nama_bidang')->get();
        return view('admin.seksi.create', compact('bidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'nama_seksi' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['shortlink_code'] = Str::random(6);

        Seksi::create($data);

        return redirect()->route('admin.seksi.index')->with('success', 'Seksi/Shortlink berhasil dibuat.');
    }

    public function edit(Seksi $seksi)
    {
        // Pastikan model Seksi ditemukan, jika tidak, akan mengembalikan 404 secara otomatis
        $bidang = Bidang::orderBy('nama_bidang')->get();
        return view('admin.seksi.edit', compact('seksi', 'bidang'));
    }

    public function update(Request $request, Seksi $seksi)
    {
        $request->validate([
            'bidang_id' => 'required|exists:bidang,id',
            'nama_seksi' => 'required|string|max:255',
        ]);

        $seksi->update($request->all());

        return redirect()->route('admin.seksi.index')->with('success', 'Seksi/Shortlink berhasil diperbarui.');
    }

    public function destroy(Seksi $seksi)
    {
        $seksi->delete();
        return redirect()->route('admin.seksi.index')->with('success', 'Seksi/Shortlink berhasil dihapus.');
    }
}
