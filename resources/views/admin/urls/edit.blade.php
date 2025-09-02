<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Url</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')
    <div class="max-w-4xl mx-auto py-12 px-6 lg:px-8 bg-gray-50 rounded-2xl shadow-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit URL / Link</h1>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.urls.update', $url->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $url->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>

                <!-- URL Asli -->
                <div class="mb-4">
                    <label for="original_url" class="block text-sm font-medium text-gray-700">Sumber Link</label>
                    <input type="url" name="original_url" id="original_url" value="{{ old('original_url', $url->original_url) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                </div>

                <!-- Shortlink Kustom -->
                <div class="mb-4">
                    <label for="shortlink" class="block text-sm font-medium text-gray-700">Shortlink Custom</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            {{ url('/') }}/
                        </span>
                        <input type="text" name="short_url" id="short_url" value="{{ old('short_url', $url->short_url) }}"
                            class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <!-- Seksi -->
                <div class="mb-4">
                    <label for="users_id" class="block text-sm font-medium text-gray-700">Seksi</label>
                    
                    @if(auth()->user()->role === 'admin')
                        <select name="users_id" id="users_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="" hidden>-- Pilih Seksi --</option>
                            @foreach($user as $seksi)
                                <option value="{{ $seksi->id }}" {{ old('users_id', $url->users_id) == $seksi->id ? 'selected' : '' }}>
                                    {{ $seksi->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 bg-gray-100 text-gray-600 sm:text-sm">
                            {{ auth()->user()->name ?? 'N/A' }}
                        </div>
                        <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                    @endif
                </div>

                <!-- Bidang -->
                <div class="mb-4">
                    <label for="bidang_id" class="block text-sm font-medium text-gray-700">Bidang</label>
                    @if(auth()->user()->role === 'admin')
                        <select name="bidang_id" id="bidang_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="" hidden>-- Pilih Bidang --</option>
                            @foreach($bidangWithSeksi as $bidang)
                                <option value="{{ $bidang->id }}" {{ old('bidang_id', $url->bidang_id) == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 bg-gray-100 text-gray-600 sm:text-sm">
                            {{ auth()->user()->bidang->nama_bidang ?? 'N/A' }}
                        </div>
                        <input type="hidden" name="bidang_id" value="{{ auth()->user()->bidang_id }}">
                    @endif
                </div>

                <!-- Tombol -->
                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.urls.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Perbarui 
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    
</body>
</html>


