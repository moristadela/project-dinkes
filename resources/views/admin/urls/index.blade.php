@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar URL</h1>

        <!-- Cards untuk total shortlink dan microsite -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <!-- Card Total Shortlink -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Total Shortlink</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $totalUrls }}</p>
                </div>
                <div class="text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11 15H13V17H11V15ZM11 7H13V13H11V7ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z"></path>
                    </svg>
                </div>
            </div>

            <!-- Card Total Microsite -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Total Microsite</h3>
                    <p class="text-2xl font-bold text-green-600">#</p>
                </div>
                <div class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21 3H3C1.895 3 1 3.895 1 5V19C1 20.105 1.895 21 3 21H21C22.105 21 23 20.105 23 19V5C23 3.895 22.105 3 21 3ZM3 5H21V19H3V5ZM5 7H19V9H5V7ZM5 11H19V13H5V11ZM5 15H15V17H5V15Z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-4 py-2">

            <div x-data="{ open: false }" class="flex justify-between items-center mb-4">
                <a href="{{ route('admin.urls.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    New
                </a>

                <div class="flex">
                    <input type="text" placeholder="Search"
                        class="border rounded-l-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                    <button class="px-4 py-2 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition text-sm">
                        Search
                    </button>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mb-3">URL List</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Short URL</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Original URL</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Bidang</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Seksi</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Created</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Updated</th>
                            <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($urls as $url)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $url->title }}</td>
                                <td class="px-4 py-2 text-sm text-blue-600">
                                    <a href="{{ url($url->short_url) }}" target="_blank">{{ $url->short_url }}</a>
                                </td>
                                <td class="px-4 py-2 text-sm text-blue-600">
                                    <a href="{{ $url->original_url }}" target="_blank">{{ Str::limit($url->original_url, 40) }}</a>
                                </td>
                                <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->bidang->nama_bidang ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->seksi->nama_seksi ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->updated_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Show (opsional, kalau pakai resource show) --}}
                                        <a href="{{ route('admin.urls.show', $url->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded hover:bg-blue-700"
                                            title="Detail">👁</a>

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.urls.edit', $url->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                            title="Edit">✏️</a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.urls.destroy', $url->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-600 text-white rounded hover:bg-red-700"
                                                title="Hapus">🗑</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- pagination kalau pakai paginate() --}}
            <div class="mt-4">
                {{ $urls->links() }}
            </div>
        </div>
    </div>
@endsection
