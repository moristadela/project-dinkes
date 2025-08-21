@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="text-center mb-10">
        <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" alt="Logo Dinkes Jateng" class="h-20 mx-auto mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Aplikasi Pemendek URL</h1>
        <p class="text-gray-600">Dinas Kesehatan Provinsi Jawa Tengah</p>
    </div>

    <!-- Form -->
    <div class="bg-white shadow-lg rounded-xl p-8">
        <form action="{{ route('shortlink.generate') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="url" name="original_url" 
                   placeholder="Tempel tautan panjang Anda di sini..."
                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <button type="submit" 
                    class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-lg font-semibold transition">
                Buat Tautan Pendek
            </button>
        </form>

        <!-- Hasil -->
        @if(session('short_url'))
            <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-lg">
                <p class="font-semibold">Tautan pendek Anda:</p>
                <a href="{{ session('short_url') }}" target="_blank" class="text-blue-700 underline">
                    {{ session('short_url') }}
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
