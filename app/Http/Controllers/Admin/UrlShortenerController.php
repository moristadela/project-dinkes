<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Models\Bidang;
use App\Models\Seksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    /**
     * Menampilkan daftar semua URL.
     */
    public function index()
    {
        // Ambil data dengan relasi bidang dan seksi untuk ditampilkan
        $urls = Url::with(['bidang', 'seksi'])->latest()->paginate(10);
        return view('admin.dashboard', compact('urls'));
    }

    /**
     * Menampilkan form untuk membuat URL baru.
     */
    public function create()
    {
        $bidang = Bidang::all();
        $seksi  = Seksi::all();

        return view('admin.create', compact('bidang', 'seksi'));
    
    }

    /**
     * Menyimpan URL baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'bidang_id' => 'required|exists:bidang,id',
            'seksi_id' => 'required|exists:seksi,id',
        ]);

        Url::create([
            'title' => $request->title,
            'original_url' => $request->original_url,
            'bidang_id' => $request->bidang_id,
            'seksi_id' => $request->seksi_id,
            'short_url' => Str::random(7), // Buat kode acak 7 karakter
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'URL berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit URL.
     */
    public function edit(Url $url)
    {
        $bidang = Bidang::orderBy('nama_bidang')->get();
        $seksi = Seksi::orderBy('nama_seksi')->get();
        return view('admin.edit', compact('url', 'bidang', 'seksi'));
    }

    /**
     * Memperbarui data URL di database.
     */
    public function update(Request $request, Url $url)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'bidang_id' => 'required|exists:bidang,id',
            'seksi_id' => 'required|exists:seksi,id',
        ]);

        $url->update($request->all());

        return redirect()->route('admin.dashboard')
                         ->with('success', 'URL berhasil diperbarui.');
    }

    /**
     * Menghapus URL dari database.
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return redirect()->route('admin.dashboard')
                         ->with('success', 'URL berhasil dihapus.');
    }
}
