@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar URL - {{ $bidang->nama_bidang }}</h1>

    <table class="w-full border border-gray-300 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Judul</th>
                <th class="border px-4 py-2">Original URL</th>
                <th class="border px-4 py-2">Short URL</th>
                <th class="border px-4 py-2">Seksi</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bidang->urls as $url)
                <tr>
                    <td class="border px-4 py-2">{{ $url->id }}</td>
                    <td class="border px-4 py-2">{{ $url->title }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ $url->original_url }}" target="_blank" class="text-blue-600 underline">
                            {{ $url->original_url }}
                        </a>
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ url($url->short_url) }}" target="_blank" class="text-green-600 underline">
                            {{ url($url->short_url) }}
                        </a>
                    </td>
                    <td class="border px-4 py-2">{{ $url->seksi->nama_seksi ?? '-' }}</td>
                    <td class="border px-4 py-2">
                        <a href="#" class="text-indigo-600">Edit</a> |
                        <a href="#" class="text-red-600">Hapus</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-2">Belum ada URL</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
