@extends('layouts.app')


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Daftar URL - Seksi {{ $seksi->nama }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg">
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Original URL</th>
                    <th class="border px-4 py-2">Short URL</th>
                    <th class="border px-4 py-2">Bidang</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($urls as $url)
                    <tr>
                        <td class="border px-4 py-2">{{ $url->id }}</td>
                        <td class="border px-4 py-2">{{ $url->title }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ $url->original_url }}" target="_blank" class="text-blue-600 underline">
                                {{ $url->original_url }}
                            </a>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ url($url->short_url) }}" target="_blank" class="text-green-600 underline">
                                {{ url($url->short_url) }}
                            </a>
                        </td>
                        <td class="border px-4 py-2">{{ $url->bidang->nama ?? '-' }}</td>
                        <td class="border px-4 py-2">
                            <a href="#" class="text-indigo-600">Edit</a> |
                            <a href="#" class="text-red-600">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
