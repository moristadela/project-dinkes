<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UrlShortener;
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
        $urls = UrlShortener::with(['bidang', 'seksi'])->latest()->paginate(10);
        return view('admin.url.index', compact('urls'));
    }

    /**
     * Menampilkan form untuk membuat URL baru.
     */
    public function create()
    {
        $bidangs = Bidang::orderBy('nama_bidang')->get();
        $seksis = Seksi::orderBy('nama_seksi')->get();
        return view('admin.url.create', compact('bidangs', 'seksis'));
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
            'seksi_id' => 'required|exists:seksis,id',
        ]);

        UrlShortener::create([
            'title' => $request->title,
            'original_url' => $request->original_url,
            'bidang_id' => $request->bidang_id,
            'seksi_id' => $request->seksi_id,
            'short_code' => Str::random(7), // Buat kode acak 7 karakter
        ]);

        return redirect()->route('admin.url.index')
                         ->with('success', 'URL berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit URL.
     */
    public function edit(UrlShortener $url)
    {
        $bidangs = Bidang::orderBy('nama_bidang')->get();
        $seksis = Seksi::orderBy('nama_seksi')->get();
        return view('admin.url.edit', compact('url', 'bidangs', 'seksis'));
    }

    /**
     * Memperbarui data URL di database.
     */
    public function update(Request $request, UrlShortener $url)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'bidang_id' => 'required|exists:bidang,id',
            'seksi_id' => 'required|exists:seksis,id',
        ]);

        $url->update($request->all());

        return redirect()->route('admin.url.index')
                         ->with('success', 'URL berhasil diperbarui.');
    }

    /**
     * Menghapus URL dari database.
     */
    public function destroy(UrlShortener $url)
    {
        $url->delete();
        return redirect()->route('admin.url.index')
                         ->with('success', 'URL berhasil dihapus.');
    }
}