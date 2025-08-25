<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DaftarLinkController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'microsite_id'  => 'required|exists:microsites,id',
            'title'         => 'required|string|max:255',
            'shortlink'     => 'required|string|max:255|unique:daftar_link',
            'original_link' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $link = DaftarLink::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Link berhasil ditambahkan',
            'data' => $link
        ], 201);
    }
    
}