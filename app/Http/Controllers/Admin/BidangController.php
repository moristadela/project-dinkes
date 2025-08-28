<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Menampilkan daftar semua bidang.
     */
    public function index()
    {
        $bidang = Bidang::all(); // Mengambil semua data Bidang
        return view('admin.bidang.index', compact('bidang'));
    }

    /**
     * Menampilkan form untuk membuat bidang baru.
     */
    public function create()
    {
        return view('admin.bidang.create');
    }

    /**
     * Menyimpan bidang baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_bidang' => 'required|string|max:255|unique:bidang,nama_bidang',
        ]);

        Bidang::create($validatedData);

        return redirect()->route('admin.bidang.index')->with('success', 'Bidang berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit bidang.
     */
    public function edit(Bidang $bidang)
    {
        return view('admin.bidang.edit', compact('bidang'));
    }

    /**
     * Memperbarui data bidang di database.
     */
    public function update(Request $request, Bidang $bidang)
    {
        $validatedData = $request->validate([
            'nama_bidang' => 'required|string|max:255|unique:bidang,nama_bidang,' . $bidang->id,
        ]);

        $bidang->update($validatedData);

        return redirect()->route('admin.bidang.index')->with('success', 'Bidang berhasil diperbarui.');
    }

    /**
     * Menghapus bidang dari database.
     */
    public function destroy(Bidang $bidang)
    {
        $bidang->delete();
        return redirect()->route('admin.bidang.index')->with('success', 'Bidang berhasil dihapus.');
    }

    
}
