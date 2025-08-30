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
    <div class="bg-white shadow-lg rounded-xl p-8 mb-10">
        <form action="{{ route('shortlink.generate') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <!-- Input Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Tautan (Opsional)</label>
                <input type="text" name="title" id="title"
                       placeholder="Masukkan judul untuk tautan Anda..."
                       class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Input URL Asli -->
            <div>
                <label for="original_url" class="block text-sm font-medium text-gray-700">Tautan Asli</label>
                <input type="url" name="original_url" id="original_url"
                       placeholder="Tempel tautan panjang Anda di sini..."
                       class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

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

    <!-- Daftar URL (Dummy Data) -->
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar URL</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Short URL</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 uppercase">Original URL</th>
                        <th class="px-4 py-2 text-center text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-4 py-2 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    @foreach($urls as $url)
                        <tr>
                            <td class="px-4 py-2">{{ $url->title ?? '-' }}</td>
                            <td class="px-4 py-2 text-blue-600">
                                <a href="{{ url($url->short_url) }}" target="_blank">{{ $url->short_url }}</a>
                            </td>
                            <td class="px-4 py-2 text-blue-600">
                                <a href="{{ $url->original_url }}" target="_blank">{{ Str::limit($url->original_url, 40) }}</a>
                            </td>
                            <td class="px-4 py-2 text-center">{{ $url->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 text-center flex justify-center gap-2">
                                <a href="{{ route('shortlink.edit', $url->id) }}" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">✏️</a>
                                <form action="{{ route('shortlink.destroy', $url->id) }}" method="POST" onsubmit="return confirm('Hapus URL ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
