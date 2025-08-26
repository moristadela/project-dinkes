@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Microsite</h2>
        <a href="{{ route('admin.microsites.create') }}" 
           class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium shadow-md">
            + Buat Microsite Baru
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tampilan Daftar Microsite dalam bentuk Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($microsites as $microsite)
            <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100 flex flex-col justify-between">
                <!-- Shortlink dan Judul -->
                <div class="mb-4">
                    <div class="text-sm text-gray-500 mb-1">
                        Shortlink
                    </div>
                    <a href="/m/{{ $microsite->shortlink }}" target="_blank" 
                       class="text-xl font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                        s.id/{{ $microsite->shortlink }}
                    </a>
                </div>

                <!-- Informasi Detil -->
                <div class="space-y-2 mb-4">
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase">Judul</div>
                        <div class="text-sm text-gray-900 font-medium">{{ $microsite->title }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-gray-500 uppercase">Bidang & Seksi</div>
                        <div class="text-sm text-gray-600">{{ $microsite->bidang }} / {{ $microsite->seksi }}</div>
                    </div>
                </div>

                <!-- Tanggal dan Aksi -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <div class="text-xs text-gray-400">
                        {{ $microsite->created_at->format('d M Y') }}
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin.microsites.edit', $microsite->id) }}" 
                           class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                        <form action="{{ route('admin.microsites.destroy', $microsite->id) }}" method="POST" 
                              class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus microsite ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500 col-span-full">
                Belum ada microsite yang dibuat.
            </div>
        @endforelse
    </div>
</div>
@endsection
