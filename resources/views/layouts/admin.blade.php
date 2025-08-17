@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Dashboard Admin</h1>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-gray-500">Total User</p>
            <h2 class="text-2xl font-bold">{{ $stats['totalUser'] }}</h2>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-gray-500">Total Bidang</p>
            <h2 class="text-2xl font-bold">{{ $stats['totalBidang'] }}</h2>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-gray-500">Total Shortlink</p>
            <h2 class="text-2xl font-bold">{{ $stats['totalShortlink'] }}</h2>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-semibold mb-4">Daftar Seksi</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="border px-3 py-2 text-left">Nama Seksi</th>
                    <th class="border px-3 py-2 text-left">Bidang</th>
                    <th class="border px-3 py-2 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seksi as $s)
                    <tr>
                        <td class="border px-3 py-2">{{ $s['nama'] }}</td>
                        <td class="border px-3 py-2">{{ $s['bidang'] }}</td>
                        <td class="border px-3 py-2 text-center">
                            <button class="px-2 py-1 bg-blue-600 text-white rounded">Edit</button>
                            <button class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
