@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Bidang</h1>

    <div class="bg-white shadow-sm rounded-lg p-4 py-2">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.bidang.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
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

        <h2 class="text-lg font-semibold text-gray-800 mb-3">Bidang List</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Bidang</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jumlah User</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($bidang as $b)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $b->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $b->nama_bidang }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $b->users->count() }}</td>
                            <td class="px-4 py-2 text-center">
                                {{-- Button Edit --}}
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.bidang.edit', $b->id) }}"
                                        class="inline-flex items-center justify-center w-14 h-8 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                        title="Edit">
                                        Edit
                                    </a>

                                {{-- Button Delete --}}
                                    <form action="{{ route('admin.bidang.destroy', $b->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-14 h-8 bg-red-600 text-white rounded hover:bg-red-700"
                                            title="Hapus">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
