<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    // Menampilkan daftar semua bidang
    public function index()
    {
        $bidangs = Bidang::latest()->paginate(10);
        return view('admin.dashboard', compact('bidang'));
    }

    // Menampilkan form untuk membuat bidang baru
    public function create()
    {
        return view('admin.create');
    }

    // Menyimpan bidang baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255|unique:bidang,nama_bidang',
        ]);

        Bidang::create($request->all());

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Bidang berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit bidang
    public function edit(Bidang $bidang)
    {
        return view('admin.edit', compact('bidang'));
    }

    // Memperbarui data bidang di database
    public function update(Request $request, Bidang $bidang)
    {
        $request->validate([
            'nama_bidang' => 'required|string|max:255|unique:bidang,nama_bidang,' . $bidang->id,
        ]);

        $bidang->update($request->all());

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Bidang berhasil diperbarui.');
    }

    // Menghapus bidang dari database
    public function destroy(Bidang $bidang)
    {
        $bidang->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Bidang berhasil dihapus.');
    }
}