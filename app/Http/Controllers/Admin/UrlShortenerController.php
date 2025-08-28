<?php
// FILE: App/Http/Controllers/Admin/UrlShortenerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Models\Bidang;
use App\Models\User;
use App\Models\Microsite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UrlShortenerController extends Controller
{
    /**
     * Menampilkan daftar semua URL.
     * Mengambil data URL terbaru dengan relasi bidang dan seksi,
     * serta menghitung total shortlink dan microsite untuk dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data dengan relasi bidang dan seksi untuk ditampilkan di tabel
        $urls = Url::with(['bidang', 'users'])->latest()->paginate(10);

        // Menghitung total shortlink dari model Url
        $totalUrls = Url::count();
        
        // Menghitung total microsite dari model Microsite
        $totalMicrosites = Microsite::count();
        
        // Mengambil data bidang dan seksi untuk form modal di dashboard
        $bidang = Bidang::all();
        $user  = User::all();

        return view('admin.urls.index', compact('urls', 'bidang', 'users', 'totalUrls', 'totalMicrosites'));
    }

    /**
     * Menampilkan form untuk membuat URL baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengambil semua data Bidang dengan relasi Seksi-nya
        $bidangWithUser = Bidang::with('users')->get();
        return view('admin.urls.create', compact('bidangWithusers'));
    }


    /**
     * Menyimpan URL baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'shortlink' => 'nullable|string|alpha_dash|max:255|unique:url,short_url',
            'bidang_id' => 'required|exists:bidang,id',
            'users_id' => 'required|exists:users,id',
        ]);

        // Perbaikan: Pastikan shortlink yang disimpan adalah yang diinputkan pengguna jika ada.
        if (empty($request->shortlink)) {
            $shortUrl = $this->generateUniqueShortUrl();
        } else {
            $shortUrl = $request->shortlink;
        }

        Url::create([
            'title' => $request->title,
            'original_url' => $request->original_url,
            'bidang_id' => $request->bidang_id,
            'users_id' => $request->users_id,
            'short_url' => $shortUrl,
        ]);

        return redirect()->route('admin.urls.index')
                             ->with('success', 'URL berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit URL yang sudah ada.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\View\View
     */
    public function edit(Url $url)
    {
        // Mengambil semua data Bidang dengan relasi Seksi-nya
        $bidangWithSeksi = Bidang::with('seksi')->get();
        return view('admin.urls.edit', compact('url', 'bidangWithSeksi'));
    }

    /**
     * Memperbarui data URL di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Url $url)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'shortlink' => 'nullable|string|alpha_dash|max:255|unique:url,short_url,' . $url->id,
            'bidang_id' => 'required|exists:bidang,id',
            'users_id' => 'required|exists:users,id',
        ]);
        
        $shortUrl = $request->shortlink ?? $url->short_url;

        $url->update([
            'title' => $request->title,
            'original_url' => $request->original_url,
            'bidang_id' => $request->bidang_id,
            'users_id' => $request->users_id,
            'short_url' => $shortUrl,
        ]);

        return redirect()->route('admin.urls.index')
                             ->with('success', 'URL berhasil diperbarui.');
    }

    /**
     * Menghapus URL dari database.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return redirect()->route('admin.urls.index')
                             ->with('success', 'URL berhasil dihapus.');
    }

    /**
     * Menampilkan form publik untuk membuat shortlink.
     *
     * @return \Illuminate\View\View
     */
    public function generateForm()
    {
        $urls = Url::latest()->get();
        return view('shortlink.index', compact('urls'));
    }


    /**
     * Menghasilkan shortlink acak dan menyimpannya ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        // Menggunakan helper untuk memastikan shortlink yang dihasilkan unik
        $short = $this->generateUniqueShortUrl();

        $url = Url::create([
            'title' => 'Generated Shortlink',
            'original_url' => $request->original_url,
            'short_url' => $short,
            'bidang_id' => null, // Mengatur ke null agar tidak memerlukan bidang/seksi
            'seksi_id' => null   // jika tidak disediakan
        ]);

        return back()->with('short_url', url($short));
    }

    /**
     * Logika penyimpanan tambahan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        // Jika form save memiliki validasi, bisa ditambahkan di sini.
        return redirect()->route('shortlink.index')->with('success', 'Shortlink berhasil disimpan!');
    }

    /**
     * Mengarahkan pengguna ke URL asli dari shortlink.
     *
     * @param  string  $short_url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToOriginal($short_url)
    {
        $url = Url::where('short_url', $short_url)->first();

        if (! $url) {
            abort(404, 'Shortlink tidak ditemukan.');
        }

        return redirect()->away($url->original_url);
    }
    
    /**
     * Helper untuk menghasilkan shortlink unik.
     *
     * @param int $length
     * @return string
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function generateUniqueShortUrl($length = 7)
    {
        do {
            $shortUrl = Str::random($length);
        } while (Url::where('short_url', $shortUrl)->exists());

        return $shortUrl;
    }
}
