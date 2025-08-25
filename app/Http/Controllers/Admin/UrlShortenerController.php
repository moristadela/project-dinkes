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

        // Mengambil total shortlink dan microsite untuk kartu (cards)
        $totalUrls = Url::count();
        // Anda mungkin memiliki model terpisah untuk microsites,
        // jadi ganti dengan 'Microsite::count()' jika ada.
        // $totalMicrosites = 15; // Dummy data sementara
        
        // Mengambil data bidang dan seksi untuk form modal di dashboard
        $bidang = Bidang::all();
        $seksi  = Seksi::all();

        return view('admin.urls.index', compact('urls', 'bidang', 'seksi', 'totalUrls'));
    }

    /**
     * Menampilkan form untuk membuat URL baru.
     */
    public function create()
    {
        $bidang = Bidang::all();
        $seksi  = Seksi::all();

        return view('admin.urls.create', compact('bidang', 'seksi'));
    
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
            'short_url' => Str::random(7),
        ]);

        return redirect()->route('admin.urls.index')
                         ->with('success', 'URL berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit URL.
     */
    public function edit(Url $url)
    {
        $bidang = Bidang::orderBy('nama_bidang')->get();
        $seksi = Seksi::orderBy('nama_seksi')->get();
        return view('admin.urls.edit', compact('url', 'bidang', 'seksi'));
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

        return redirect()->route('admin.urls.index')
                         ->with('success', 'URL berhasil diperbarui.');
    }

    /**
     * Menghapus URL dari database.
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return redirect()->route('admin.urls.index')
                         ->with('success', 'URL berhasil dihapus.');
    }

    public function generateForm()
    {
        $urls = Url::latest()->get(); // ambil semua data url
        return view('shortlink.index', compact('urls'));
    }


    public function generate(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        // bikin shortlink random
        $short = Str::random(7);

        // simpan ke database
        $url = \App\Models\Url::create([
            'title' => 'Generated Shortlink',
            'original_url' => $request->original_url,
            'short_url' => $short,
            'bidang_id' => 1, // sementara dummy, nanti bisa pilih
            'seksi_id' => 1   // sementara dummy
        ]);

        return back()->with('short_url', url($short));
    }

    public function save(Request $request)
    {
        // logika penyimpanan tambahan (kalau perlu update title/bidang/seksi)
        return redirect()->route('shortlink.index')->with('success', 'Shortlink berhasil disimpan!');
    }

    public function redirectToOriginal($short_url)
    {
        $url = Url::where('short_url', $short_url)->first();

        if (! $url) {
            abort(404, 'Shortlink tidak ditemukan.');
        }

        return redirect()->away($url->original_url);
}

}
