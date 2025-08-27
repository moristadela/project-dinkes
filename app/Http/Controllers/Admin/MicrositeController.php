<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Microsite;
use App\Models\Bidang;
use Illuminate\Http\Request;

class MicrositeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $microsites = Microsite::with(['bidang', 'seksi'])->latest()->get();
        return view('admin.microsites.index', compact('microsites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allBidang = Bidang::with('seksi')->get();
        return view('admin.microsites.create', compact('allBidang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shortlink' => 'required|string|max:255|unique:microsites,shortlink',
            'title' => 'required|string|max:255',
            'bidang' => 'required|exists:bidang,id',
            'seksi' => 'required|exists:seksi,id',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url' => 'nullable|url|max:255',
        ]);

        $microsite = new Microsite();
        $microsite->shortlink = $request->shortlink;
        $microsite->title = $request->title;
        $microsite->bidang_id = $request->bidang;
        $microsite->seksi_id = $request->seksi;
        $microsite->save();

        if ($request->links) {
            foreach ($request->links as $link) {
                if ($link['title'] && $link['url']) {
                    $microsite->links()->create([
                        'title' => $link['title'],
                        'original_link' => $link['url'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.microsites.index')->with('success', 'Microsite berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($shortlink)
    {
        // Memuat relasi 'bidang' dan 'seksi'
        $microsite = Microsite::where('shortlink', $shortlink)
                              ->with(['links', 'bidang', 'seksi'])
                              ->firstOrFail();

        return view('microsite.show', compact('microsite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Microsite $microsite)
    {
        $allBidang = Bidang::with('seksi')->get();
        return view('admin.microsites.edit', compact('microsite', 'allBidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Microsite $microsite)
    {
        $request->validate([
            'shortlink' => 'required|string|max:255|unique:microsites,shortlink,' . $microsite->id,
            'title' => 'required|string|max:255',
            'bidang' => 'required|exists:bidang,id',
            'seksi' => 'required|exists:seksi,id',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url' => 'nullable|url|max:255',
        ]);

        $microsite->update([
            'shortlink' => $request->shortlink,
            'title' => $request->title,
            'bidang_id' => $request->bidang,
            'seksi_id' => $request->seksi,
        ]);

        // Delete existing links that are not in the request
        $requestedLinkIds = collect($request->links)->pluck('id')->filter()->all();
        $microsite->links()->whereNotIn('id', $requestedLinkIds)->delete();

        // Update or create new links
        if ($request->links) {
            foreach ($request->links as $linkData) {
                if ($linkData['title'] && $linkData['url']) {
                    if (isset($linkData['id'])) {
                        // Update existing link
                        $microsite->links()->where('id', $linkData['id'])->update([
                            'title' => $linkData['title'],
                            'original_link' => $linkData['url'],
                        ]);
                    } else {
                        // Create new link
                        $microsite->links()->create([
                            'title' => $linkData['title'],
                            'original_link' => $linkData['url'],
                        ]);
                    }
                }
            }
        }
        
        return redirect()->route('admin.microsites.index')->with('success', 'Microsite berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Microsite $microsite)
    {
        $microsite->delete();
        return redirect()->route('admin.microsites.index')->with('success', 'Microsite berhasil dihapus!');
    }
}
