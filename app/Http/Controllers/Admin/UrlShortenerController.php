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
use Exception;

class UrlShortenerController extends Controller
{
    /**
     * Menampilkan daftar URL yang dibuat oleh seksi dari user yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
<<<<<<< HEAD
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
=======
        // Mendapatkan user yang sedang login
        $user = auth()->user();
        
        // Ambil URLs yang dibuat oleh seksi dari user yang sedang login
        // Eager load relasi bidang dan seksi untuk performa yang lebih baik
        $urls = Url::where('seksi_id', $user->seksi_id)
                    ->with(['bidang', 'seksi'])
                    ->latest()
                    ->paginate(10);

        // Menghitung total URL dan microsite untuk seksi dari user yang sedang login
        $totalUrls = Url::where('seksi_id', $user->seksi_id)->count();
        $totalMicrosites = Microsite::where('seksi_id', $user->seksi_id)->count();
        
        return view('admin.urls.index', compact('urls', 'totalUrls', 'totalMicrosites'));
>>>>>>> b1f087925effe190350b1045676a9468f6854fd5
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
<<<<<<< HEAD
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'shortlink' => 'nullable|string|alpha_dash|max:255|unique:url,short_url',
            'bidang_id' => 'required|exists:bidang,id',
            'users_id' => 'required|exists:users,id',
        ]);
=======
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'original_url' => 'required|url',
                'shortlink' => 'nullable|string|alpha_dash|max:255|unique:url,short_url',
                'bidang_id' => 'required|exists:bidang,id',
                'seksi_id' => 'required|exists:seksi,id',
            ]);
>>>>>>> b1f087925effe190350b1045676a9468f6854fd5

            // Pastikan shortlink yang disimpan adalah yang diinputkan pengguna jika ada.
            if (empty($request->shortlink)) {
                $shortUrl = $this->generateUniqueShortUrl();
            } else {
                $shortUrl = $request->shortlink;
            }

            Url::create([
                'title' => $request->title,
                'original_url' => $request->original_url,
                'bidang_id' => $request->bidang_id,
                'seksi_id' => $request->seksi_id,
                'short_url' => $shortUrl,
                'user_id' => auth()->id(), // Tambahkan user_id dari user yang sedang login
            ]);

            return redirect()->route('admin.urls.index')
                                 ->with('success', 'URL berhasil ditambahkan.');

        } catch (ValidationException $e) {
            // Tangani error validasi
            return redirect()->back()
                             ->withErrors($e->errors())
                             ->withInput();
        } catch (Exception $e) {
            // Tangani error lain, misalnya error database
            // Log the error for debugging
            // \Log::error('Error creating URL: ' . $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat menyimpan URL. Silakan coba lagi. Pesan Error: ' . $e->getMessage())
                             ->withInput();
        }
<<<<<<< HEAD

        Url::create([
            'title' => $request->title,
            'original_url' => $request->original_url,
            'bidang_id' => $request->bidang_id,
            'users_id' => $request->users_id,
            'short_url' => $shortUrl,
        ]);

        return redirect()->route('admin.urls.index')
                             ->with('success', 'URL berhasil ditambahkan.');
=======
>>>>>>> b1f087925effe190350b1045676a9468f6854fd5
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
<<<<<<< HEAD
=======
            // Validasi shortlink, mengecualikan URL saat ini menggunakan id
>>>>>>> b1f087925effe190350b1045676a9468f6854fd5
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
            'seksi_id' => null,  // jika tidak disediakan
            'user_id' => null,   // Mengatur ke null untuk shortlink publik
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
