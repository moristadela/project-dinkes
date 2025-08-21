@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

    <div class="bg-white shadow-sm rounded-lg p-4 py-2">

        <div x-data="{ open: false }" class="flex justify-between items-center mb-4">
            <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
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
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">ID Bidang</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">ID Seksi</th>
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
                                <a href="{{ $url->short_url }}" target="_blank">{{ $url->short_url }}</a>
                            </td>
                            <td class="px-4 py-2 text-sm text-blue-600">
                                <a href="{{ $url->original_url }}" target="_blank">{{ $url->original_url }}</a>
                            </td>
                            <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->bidang_id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->seksi_id }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->created_at }}</td>
                            <td class="px-4 py-2 text-center text-sm text-gray-500">{{ $url->updated_at }}</td>
                            <td class="px-4 py-2">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Show (opsional, kalau pakai resource show) --}}
                                    <a href="{{ route('admin.url.show', $url->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded hover:bg-blue-700"
                                        title="Detail">👁</a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.url.edit', $url->id) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                        title="Edit">✏️</a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.url.destroy', $url->id) }}" method="POST"
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

@include('admin.create')

@endsection