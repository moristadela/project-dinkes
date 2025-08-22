@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Microsite Shortlink</h2>
        <a href="{{ route('admin.seksi.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 text-sm">← Kembali</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Form -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Pengaturan Microsite</h3>
            
            <form action="{{ route('microsite.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nama Microsite -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Microsite</label>
                    <input type="text" name="title" class="mt-1 w-full border rounded-lg p-2 focus:ring-green-500 focus:border-green-500" value="{{ $microsite->title }}">
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Slug</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 rounded-l-lg text-gray-500 text-sm">/s/</span>
                        <input type="text" name="slug" class="flex-1 border rounded-r-lg p-2 focus:ring-green-500 focus:border-green-500" value="{{ $microsite->slug }}">
                    </div>
                </div>

                <!-- URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">URL Tujuan Utama</label>
                    <input type="url" name="url" class="mt-1 w-full border rounded-lg p-2 focus:ring-green-500 focus:border-green-500" value="{{ $microsite->url }}">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Preview -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-green-700">Pratinjau Microsite</h3>
            <div class="bg-gradient-to-b from-red-100 to-red-200 p-8 rounded-2xl shadow-md flex flex-col items-center">
                <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" alt="Logo Dinkes" class="w-28 h-28 rounded-full shadow-lg mb-4">
                <h4 class="text-xl font-bold text-gray-900 text-center">{{ $microsite->title }}</h4>
                <p class="text-gray-600 text-center mb-6">Kumpulan Shortlink Resmi</p>
                <div class="w-full max-w-xs space-y-4">
                    @forelse ($seksi as $s)
                        <a href="{{ url('/s/' . $s->shortlink_code) }}" target="_blank" class="block w-full bg-white shadow hover:shadow-lg rounded-xl px-4 py-3 text-center font-medium text-gray-800">
                            {{ $s->nama_seksi }}
                        </a>
                    @empty
                         <p class="text-center text-gray-500">Belum ada shortlink yang terdaftar.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
