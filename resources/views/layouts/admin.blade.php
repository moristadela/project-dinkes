@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-2">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total User Card --}}
        <div class="bg-white shadow-sm rounded-lg p-6 text-center">
            <p class="text-sm text-gray-500">Total User</p>
            <h2 class="text-4xl font-bold text-gray-900 mt-2">{{ $stats['totalUser'] }}</h2>
        </div>
        {{-- Total Bidang Card --}}
        <div class="bg-white shadow-sm rounded-lg p-6 text-center">
            <p class="text-sm text-gray-500">Total Bidang</p>
            <h2 class="text-4xl font-bold text-gray-900 mt-2">{{ $stats['totalBidang'] }}</h2>
        </div>
        {{-- Total Shortlink Card --}}
        <div class="bg-white shadow-sm rounded-lg p-6 text-center">
            <p class="text-sm text-gray-500">Total Shortlink</p>
            <h2 class="text-4xl font-bold text-gray-900 mt-2">{{ $stats['totalShortlink'] }}</h2>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Seksi</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Seksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bidang</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($seksi as $s)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $s['nama'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $s['bidang'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <a href="#" class="inline-block px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Edit</a>
                                <a href="#" class="inline-block px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 ml-2 transition">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection