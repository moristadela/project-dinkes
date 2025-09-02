<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microsite;
use App\Models\Bidang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MicrositeController extends Controller
{
    public function index()
    {
        if (Auth::id()==1) {
            $microsites = Microsite::with(['bidang', 'user', 'daftarLinks'])
                                                ->paginate(10);
        } else {
            $microsites = Microsite::with(['bidang', 'user', 'daftarLinks'])
                        ->where('users_id', Auth::id())
                        ->paginate(10);
        }
        
        

        $totalMicrosites = $microsites->total();

        return view('admin.microsites.index', compact('microsites', 'totalMicrosites'));
    }

    public function create()
    {
        $bidangWithSeksi = Bidang::with('seksi')->get();
       $user = User::all();
        return view('admin.microsites.create', compact('bidangWithSeksi', 'user'));
    }

    // File: MicrositeController.php

    public function store(Request $request)
    {
 
        $request->validate([
            'shortlink' => [
                'required', 'string', 'max:255', Rule::unique('microsites', 'shortlink')
            ],
            'title' => 'required|string|max:255',
            'bidang_id' => 'required|exists:bidang,id',
            'tanggal' => 'required',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url' => 'required_with:links.*.title|nullable|url|max:2048',
        ]);

        $micrositeData = $request->only(['shortlink', 'title', 'bidang_id', 'tanggal', 'users_id']);

        $tanggal = Carbon::parse($request->tanggal)
            ->setTimeFrom(Carbon::now());

        $micrositeData['tanggal'] = $tanggal;

        $microsite = Microsite::create($micrositeData);

        if ($request->has('links') && is_array($request->links)) {
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

        $tanggal = Carbon::parse($request->tanggal)
            ->setTimeFrom(Carbon::now());

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
        $microsite = Microsite::with('daftarLinks')
            ->where('shortlink', $shortlink)
            ->firstOrFail();
        return view('microsite.show', compact('microsite'));
    }


}