<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Daftar URL</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div class="bg-white rounded-3xl shadow-lg p-6 flex items-center space-x-4 transition-transform duration-300 transform hover:scale-105">
                <div class="flex-shrink-0 bg-blue-100 text-blue-600 rounded-full p-3">
                    <i class="fas fa-link fa-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Jumlah Shortlink</h3>
                    <p class="text-3xl font-extrabold text-blue-700">{{ $totalUrls }}</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6 flex items-center space-x-4 transition-transform duration-300 transform hover:scale-105">
                <div class="flex-shrink-0 bg-green-100 text-green-600 rounded-full p-3">
                    <i class="fas fa-list-alt fa-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Jumlah Microsite</h3>
                    <p class="text-3xl font-extrabold text-green-700">{{ $totalMicrosites }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-lg rounded-3xl p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <a href="{{ route('admin.urls.create') }}" class="w-full md:w-auto px-6 py-3 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition-colors mb-4 md:mb-0 transform hover:-translate-y-1">
                    <i class="fas fa-plus mr-2"></i> Buat URL Baru
                </a>
                <div class="w-full md:w-1/3 flex">
                    <input type="text" placeholder="Cari URL..."
                           class="flex-1 border border-gray-300 rounded-l-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                    <button class="px-5 py-2 bg-blue-600 text-white rounded-r-full hover:bg-blue-700 transition-colors text-sm">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Daftar URL yang Ada</h2>

            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">URL Singkat</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">URL Asli</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Seksi</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Bidang</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Dibuat</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Diperbarui</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($urls as $url)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    {{ $url->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ url($url->short_url) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $url->short_url }}
                                    </a>
                                </td>
                               <td class="px-6 py-4 text-sm max-w-[200px] truncate">
                                    <a href="{{ $url->original_url }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800"
                                        title="{{ $url->original_url }}">
                                        {{ $url->original_url }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{ $url->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{ $url->bidang->nama_bidang ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{ $url->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-500">
                                    {{ $url->updated_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.urls.edit', $url->id) }}"
                                        class="px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 text-xs font-medium transition">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.urls.destroy', $url->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs font-medium transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500 italic">
                                    Belum ada data. Tambahkan URL baru untuk mulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


           </div>
    </div>
@endsection
    
</body>
</html>


