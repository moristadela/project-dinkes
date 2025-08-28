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
                </div>
            </div>

            <!-- Card Total Microsite -->
            <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-500">Total Microsite</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $totalMicrosites }}</p>
                </div>
                <div class="text-green-600">
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
                                <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->updated_at->format('d M Y') }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.urls.edit', $url->id) }}"
                                            class="inline-flex items-center justify-center w-14 h-8 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                            title="Edit">Edit</a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.urls.destroy', $url->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-14 h-8 bg-red-600 text-white rounded hover:bg-red-700"
                                                title="Hapus">Delete</button>
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
