@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Seksi</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.seksi.update', $seksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="bidang_id" class="block text-sm font-medium text-gray-700">Bidang</label>
                <select name="bidang_id" id="bidang_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="">Pilih Bidang</option>
                    @foreach($bidang as $b)
                        <option value="{{ $b->id }}" @if($b->id == $seksi->bidang_id) selected @endif>{{ $b->nama_bidang }}</option>
                    @endforeach
                </select>
                @error('bidang_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_seksi" class="block text-sm font-medium text-gray-700">Nama Seksi</label>
                <input type="text" name="nama_seksi" id="nama_seksi" value="{{ old('nama_seksi', $seksi->nama_seksi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                @error('nama_seksi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.seksi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition mr-2">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
