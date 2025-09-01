<?php
// FILE: App/Http/Controllers/Admin/UrlShortenerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Url;
use App\Models\Bidang;
use App\Models\Microsite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class UrlShortenerController extends Controller
{
    /**
     * Menampilkan daftar semua URL.
     *
     * @return \Illuminate\View\View
     */
    
    public function index()
    {
        // Ambil URL hanya untuk pengguna yang sedang login
        if (Auth::id()==1) {$urls = Url::with(['bidang', 'seksi', 'user'])
                    ->get();
            # code...
        } else {
            $urls = Url::with(['bidang', 'seksi', 'user'])
                    ->where('users_id', Auth::id())
                    ->get();
        }
        
        

        // Ambil total URL dari pagination
        $totalUrls = $urls->count();

        // Ambil jumlah total microsite milik user yang sedang login
        $totalMicrosites = Microsite::where('users_id', Auth::id())->count();

        // Kirimkan semua data ke view
        return view('admin.urls.index', compact('urls', 'totalUrls', 'totalMicrosites'));
    }

    /**
     * Menampilkan form untuk membuat URL baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $bidangWithSeksi = Bidang::with('seksi')->get();
       $user = User::all();

        return view('admin.urls.create', compact('bidangWithSeksi','user'));
    

    }

    /**
     * Menyimpan URL baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'bidang_id' => 'required|exists:bidang,id', // pastikan nama tabel benar
            'shortlink' => 'nullable|string|max:20|alpha_dash|unique:url,short_url',
            'users_id' => 'required|exists:users,id',
        ]);

        // Siapkan data untuk disimpan
        $data = $request->except(['shortlink']);
        $data['short_url'] = $request->input('shortlink') ?? Str::random(6);

        // $data['users_id'] = Auth::id(); // lebih umum pakai user_id

        // Buat record URL baru
        Url::create($data);

        return redirect()->route('admin.urls.index')->with('success', 'URL berhasil dibuat!');
    }


    /**
     * Menampilkan form untuk mengedit URL yang sudah ada.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\View\View
     */
    public function edit(Url $url)
    {
        $bidangWithSeksi = Bidang::with('seksi')->get();
        return view('admin.urls.edit', compact('url', 'bidangWithSeksi'));
    }

    /**
     * Memperbarui URL di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Url $url)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'original_url' => 'required|url',
            'bidang_id' => 'required|exists:bidang,id',
            'shortlink' => [
                'nullable',
                'string',
                'max:20',
                'alpha_dash',
                Rule::unique('url', 'short_url')->ignore($url->id),
            ],
        ]);

        // Siapkan data untuk diperbarui, termasuk users_id dari pengguna yang terautentikasi
        $data = $request->except(['shortlink']);
        $data['short_url'] = $request->input('shortlink') ?? $url->short_url;
        $data['users_id'] = Auth::id(); // Mengambil ID pengguna yang sedang login

        // Perbarui record URL
        $url->update($data);

        return redirect()->route('admin.urls.index')->with('success', 'URL berhasil diperbarui!');
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
        return redirect()->route('admin.urls.index')->with('success', 'URL berhasil dihapus!');
    }

    public function getSeksi($bidang_id)
    {
        $users = \App\Models\User::where('bidang_id', $bidang_id)->get();
        return response()->json($users);
    }

}
