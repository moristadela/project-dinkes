<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microsite;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MicrositeController extends Controller
{
    /**
     * Menampilkan daftar semua Microsite.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil microsite hanya untuk pengguna yang sedang login
        $microsites = Microsite::with(['bidang', 'seksi', 'user'])
                        ->where('users_id', Auth::id())
                        ->paginate(10);

        // Hitung total microsite
        $totalMicrosites = $microsites->total();

        return view('admin.microsites.index', compact('microsites', 'totalMicrosites'));
    }

    /**
     * Menampilkan form untuk membuat Microsite baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $bidangWithSeksi = Bidang::with('seksi')->get();
        return view('admin.microsites.create', compact('bidangWithSeksi'));
    }

    /**
     * Menyimpan Microsite baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'shortlink' => [
                'required',
                'string',
                'max:255',
                Rule::unique('microsites', 'shortlink')
            ],
            'title' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
        ]);

        $data = $request->only(['shortlink', 'title', 'bidang_id']);
        $data['users_id'] = Auth::id();

        Microsite::create($data);

        return redirect()->route('admin.microsites.index')->with('success', 'Microsite berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk mengedit Microsite.
     *
     * @param  \App\Models\Microsite  $microsite
     * @return \Illuminate\View\View
     */
    public function edit(Microsite $microsite)
    {
        // Pastikan hanya pemiliknya yang bisa edit
        if (Auth::id() !== $microsite->users_id) {
            abort(403);
        }

        $bidangWithSeksi = Bidang::with('seksi')->get();
        return view('admin.microsites.edit', compact('microsite', 'bidangWithSeksi'));
    }

    /**
     * Memperbarui Microsite di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Microsite  $microsite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Microsite $microsite)
    {
        // Validasi
        $request->validate([
            'shortlink' => [
                'required',
                Rule::unique('microsites')->ignore($microsite->id),
            ],
            'title' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
            'links.*.original_link' => 'nullable|url',
            'links.*.title' => 'nullable|string',
        ]);

        // Update microsite
        $microsite->update([
            'shortlink' => $request->shortlink,
            'title' => $request->title,
            'bidang_id' => $request->bidang_id,
        ]);

        // Hapus semua link lama lalu simpan ulang (opsional, tergantung use case)
        if ($request->has('links')) {
            $microsite->links()->delete();
            foreach ($request->links as $link) {
                $microsite->links()->create([
                    'original_link' => $link['original_link'],
                    'title' => $link['title'],
                ]);
            }
        }

        return redirect()->route('admin.microsites.index')->with('success', 'Microsite berhasil diperbarui!');
    }

    /**
     * Menghapus Microsite dari database.
     *
     * @param  \App\Models\Microsite  $microsite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Microsite $microsite)
    {
        if (Auth::id() !== $microsite->users_id) {
            abort(403);
        }

        $microsite->delete();

        return redirect()->route('admin.microsites.index')->with('success', 'Microsite berhasil dihapus!');
    }

    public function showPublic($shortlink)
    {
        $microsite = Microsite::with('daftarLinks')->where('shortlink', $shortlink)->firstOrFail();
        return view('microsite.show', compact('microsite'));
    }


}
