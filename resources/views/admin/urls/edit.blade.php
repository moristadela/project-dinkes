{{-- FILE: resources/views/admin/urls/edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">

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
                <input type="url" name="original_url" id="original_url" value="{{ old('original_url', $url->original_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="https://contoh.com" required>
            </div>

            <div class="mb-4">
                <label for="shortlink" class="block text-sm font-medium text-gray-700">Shortlink Kustom (Opsional)</label>
                <input type="text" name="shortlink" id="shortlink" value="{{ old('shortlink', $url->short_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="contoh-shortlink">
            </div>

            <div class="mb-4">
                <label for="users_id" class="block text-sm font-medium text-gray-700">Seksi</label>

                @if(auth()->user()->role === 'admin')
                <!-- Dropdown untuk admin -->
                 <select name="users_id" id="users_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="" hidden>-- Pilih Seksi --</option>
                    @foreach($user as $seksi)
                            <option value="{{ $seksi->id }}">
                                  {{ $seksi->name }}
                            </option>
                        @endforeach
                </select>

                    @error('users_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                @else
                    <!-- Read only untuk user biasa -->
                    <div class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                px-3 py-2 bg-gray-100 text-gray-600 sm:text-sm">
                        {{ auth()->user()->name ?? 'N/A' }}
                    </div>
                    <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                @endif
            </div>

            <div class="mb-4">
                <label for="bidang_id" class="block text-sm font-medium text-gray-700">Bidang</label>
                <select name="bidang_id" id="bidang_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="">Pilih Bidang</option>
                    @foreach($bidangWithSeksi as $bidang)
                        <option value="{{ $bidang->id }}" {{ old('bidang_id', $url->bidang_id) == $bidang->id ? 'selected' : '' }}>
                            {{ $bidang->nama_bidang }}
                        </option>
                    @endforeach
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
