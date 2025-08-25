@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="text-center mb-10">
        <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" alt="Logo Dinkes Jateng" class="h-20 mx-auto mb-4">
        <h1 class="text-3xl font-bold text-gray-800">URL Shortener</h1>
        <p class="text-gray-600">Dinas Kesehatan Provinsi Jawa Tengah</p>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-xl p-8">
        <form action="{{ route('shortlink.generate') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <!-- Input untuk Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Tautan (Opsional)</label>
                <input type="text" name="title" id="title"
                       placeholder="Masukkan judul tautan Anda..."
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Input untuk URL Asli -->
            <div>
                <label for="original_url" class="block text-sm font-medium text-gray-700 mb-1">URL Asli</label>
                <input type="url" name="original_url" id="original_url"
                       placeholder="Tempel tautan panjang Anda di sini..."
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-center mt-2">
                <button type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Buat Tautan Pendek
                </button>
            </div>
        </form>

        <!-- Menampilkan pesan sukses -->
        @if(session('short_url'))
            <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-lg">
                <p class="font-semibold">Tautan pendek Anda:</p>
                <a href="{{ session('short_url') }}" target="_blank" class="text-blue-700 underline break-all">
                    {{ session('short_url') }}
                </a>
            </div>
        @endif

        <!-- Menampilkan pesan error validasi -->
        @if ($errors->any())
            <div class="mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection
