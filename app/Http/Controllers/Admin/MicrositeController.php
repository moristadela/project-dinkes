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
    public function index()
    {
        $microsites = Microsite::with(['bidang', 'user', 'daftarLinks'])
                        ->where('users_id', Auth::id())
                        ->paginate(10);

        $totalMicrosites = $microsites->total();

        return view('admin.microsites.index', compact('microsites', 'totalMicrosites'));
    }

    public function create()
    {
        $bidangs = Bidang::all();
        return view('admin.microsites.create', compact('bidangs'));
    }

    // File: MicrositeController.php

    public function store(Request $request)
    {
        // 1. Tambahkan validasi untuk link (sama seperti di method update)
        $request->validate([
            'shortlink' => [
                'required', 'string', 'max:255', Rule::unique('microsites', 'shortlink')
            ],
            'title' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
            'tanggal' => 'required|date',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url' => 'required_with:links.*.title|nullable|url|max:2048',
        ]);

        // 2. Buat data microsite utama
        $micrositeData = $request->only(['shortlink', 'title', 'bidang_id', 'tanggal']);
        $micrositeData['users_id'] = Auth::id();

        // 3. Buat microsite dan simpan hasilnya ke dalam variabel
        $microsite = Microsite::create($micrositeData);

        // 4. Tambahkan logika untuk menyimpan link
        if ($request->has('links') && is_array($request->links)) {
            foreach ($request->links as $link) {
                // Pastikan URL tidak kosong sebelum menyimpan
                if (!empty($link['url'])) {
                    $microsite->daftarLinks()->create([
                        'original_link' => $link['url'],
                        'title' => $link['title'] ?? null,
                        // Buat shortlink acak sederhana untuk setiap link
                        'shortlink' => substr(md5($link['url'] . time()), 0, 6),
                    ]);
                }
            }
        }

        return redirect()->route('admin.microsites.index')
            ->with('success', 'Microsite berhasil dibuat!');
    }

    public function edit(Microsite $microsite)
    {
        if (Auth::id() !== $microsite->users_id) {
            abort(403);
        }

        $bidangs = Bidang::all();

        $user = Auth::user();
        $bidangWithSeksi = $user->bidang ? $user->bidang->seksi : collect();

        return view('admin.microsites.edit', compact('microsite', 'bidangs', 'bidangWithSeksi'));
    }

    public function update(Request $request, Microsite $microsite)
    {
        // Validasi microsite dan links
        $request->validate([
            'shortlink' => [
                'required',
                Rule::unique('microsites')->ignore($microsite->id),
            ],
            'title' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
            'tanggal' => 'required|date',
            'links.*.url' => 'nullable|url',
            'links.*.title' => 'nullable|string|max:255',
        ]);

        // Update data microsite utama
        $microsite->update([
            'shortlink' => $request->shortlink,
            'title' => $request->title,
            'bidang_id' => $request->bidang_id,
            'tanggal' => $request->tanggal,
        ]);

        if ($request->has('links') && is_array($request->links)) {
            $microsite->daftarLinks()->delete();

            foreach ($request->links as $link) {
                if (!empty($link['url'])) { 
                    $microsite->daftarLinks()->create([
                        'original_link' => $link['url'],
                        'title' => $link['title'] ?? null,
                        'shortlink' => substr(md5($link['url'] . time()), 0, 6),
                    ]);
                }
            }
        }

        return redirect()->route('admin.microsites.index')
                        ->with('success', 'Microsite berhasil diperbarui!');
    }

    public function destroy(Microsite $microsite)
    {
        if (Auth::id() !== $microsite->users_id) {
            abort(403);
        }

        $microsite->delete();

        return redirect()->route('admin.microsites.index')
            ->with('success', 'Microsite berhasil dihapus!');
    }

    public function showPublic($shortlink)
    {
        $microsite = Microsite::with('daftarLinks')->where('shortlink', $shortlink)->firstOrFail();
        return view('microsite.show', compact('microsite'));
    }
}