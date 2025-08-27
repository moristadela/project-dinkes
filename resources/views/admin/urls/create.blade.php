@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6" 
     x-data="{
        bidangId: '',
        seksiList: [],
        allBidang: {{ $bidang->toJson() }}
     }"
     x-effect="
     let bidang = allBidang.find(b => b.id == bidangId);
     seksiList = bidang ? bidang.seksi : [];
     ">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Buat URL Baru</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.urls.store') }}" method="POST">
            @csrf

            <!-- Judul -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL Asli -->
            <div class="mb-4">
                <label for="original_url" class="block text-sm font-medium text-gray-700">URL Asli</label>
                <input type="url" name="original_url" id="original_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="https://contoh.com" required>
                @error('original_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bidang -->
            <div class="mb-4">
                <label for="bidang_id" class="block text-sm font-medium text-gray-700">Bidang</label>
                <select name="bidang_id" id="bidang_id" 
                        x-model="bidangId"
                        class="mt-1 block w-full ...">
                    <option value="">Pilih Bidang</option>
                    <template x-for="b in allBidang" :key="b.id">
                        <option :value="b.id" x-text="b.nama_bidang"></option>
                    </template>
                </select>


                @error('bidang_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Seksi -->
            <div class="mb-4">
                <label for="seksi_id" class="block text-sm font-medium text-gray-700">Seksi</label>
                <select name="seksi_id" id="seksi_id" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="">Pilih Seksi</option>
                    <template x-for="s in seksiList" :key="s.id">
                        <option :value="s.id" x-text="s.nama_seksi"></option>
                    </template>
                </select>
                @error('seksi_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.urls.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition mr-2">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
