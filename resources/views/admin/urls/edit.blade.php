@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6" 
     x-data="{
         // Inisialisasi data Alpine.js dengan nilai dari server
         bidangId: '{{ old('bidang_id', $url->bidang_id) }}',
         seksiId: '{{ old('seksi_id', $url->seksi_id) }}',
         seksiList: [],
         allBidang: {{ $allBidang->toJson() }}
     }"
     x-init="
         // Gunakan $watch untuk bereaksi terhadap perubahan pada bidangId
         $watch('bidangId', value => {
             let bidang = allBidang.find(b => b.id == value);
             seksiList = bidang ? bidang.seksi : [];
             // Jika bidangId berubah, reset seksiId agar tidak ada pilihan yang salah
             // unless the new bidang has the current seksi
             if (seksiList.findIndex(s => s.id == seksiId) === -1) {
                 seksiId = '';
             }
         });
         // Panggil logika filter saat inisialisasi untuk memuat seksi awal
         let initialBidang = allBidang.find(b => b.id == bidangId);
         if (initialBidang) {
             seksiList = initialBidang.seksi;
         }
     ">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit URL</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.urls.update', $url->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Menampilkan pesan error validasi -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $url->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="original_url" class="block text-sm font-medium text-gray-700">URL Asli</label>
                <input type="url" name="original_url" id="original_url" value="{{ old('original_url', $url->original_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="[https://contoh.com](https://contoh.com)" required>
            </div>

            <div class="mb-4">
                <label for="bidang_id" class="block text-sm font-medium text-gray-700">Bidang</label>
                <select name="bidang_id" id="bidang_id" 
                        x-model="bidangId"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="">Pilih Bidang</option>
                    <template x-for="b in allBidang" :key="b.id">
                        <option :value="b.id" x-text="b.nama_bidang"></option>
                    </template>
                </select>
            </div>

            <div class="mb-4">
                <label for="seksi_id" class="block text-sm font-medium text-gray-700">Seksi</label>
                <select name="seksi_id" id="seksi_id" 
                        x-model="seksiId"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="">Pilih Seksi</option>
                    <template x-if="seksiList.length === 0 && bidangId !== ''">
                        <option value="" disabled>Tidak ada seksi</option>
                    </template>
                    <template x-for="s in seksiList" :key="s.id">
                        <option :value="s.id" x-text="s.nama_seksi"></option>
                    </template>
                </select>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.urls.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition mr-2">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
