<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DaftarLinkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'microsite_id'  => 'required|exists:microsites,id',
            'title'         => 'required|string|max:255',
            'shortlink'     => [
                'required',
                'string',
                'max:255',
                // Pastikan shortlink unik dalam cakupan microsite_id
                Rule::unique('daftar_link')->where(function ($query) use ($request) {
                    return $query->where('microsite_id', $request->microsite_id);
                }),
            ],
            'original_link' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $link = DaftarLink::create([
            'microsite_id'  => $request->microsite_id,
            'title'         => $request->title,
            'shortlink'     => $request->shortlink,
            'original_link' => $request->original_link,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Link berhasil ditambahkan',
            'data' => $link
        ], 201);
    }
}
