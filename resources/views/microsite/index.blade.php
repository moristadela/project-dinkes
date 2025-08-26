@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6" 
     x-data="{ 
        micrositeTitle: 'Dinas Kesehatan Provinsi Jawa Tengah', 
        micrositeDescription: 'Kumpulan Shortlink Resmi',
        micrositeSlug: 'dinkes-jateng',
        links: [
            { title: 'Dashboard Dinkes', url: 'https://dinkes.jatengprov.go.id' },
            { title: 'Data Covid-19', url: 'https://corona.jatengprov.go.id' }
        ] 
     }">

    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800"> Buat Microsite Baru</h2>
        <a href="{{ route('admin.microsites.index') }}" 
           class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-sm font-medium">
           ← Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kolom Form -->
        <div class="bg-white shadow-lg rounded-2xl p-8 space-y-8 border border-gray-100">
            <h3 class="text-xl font-semibold text-green-700">Pengaturan Microsite</h3>
            
            <form class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Microsite</label>
                    <input type="text" x-model="micrositeTitle" 
                           class="mt-1 w-full border rounded-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm">
                </div>
                
                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi Microsite</label>
                    <textarea x-model="micrositeDescription" rows="2"
                           class="mt-1 w-full border rounded-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm"></textarea>
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Slug</label>
                    <div class="flex mt-1">
                        <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 rounded-l-xl text-gray-500 text-sm">https://dinkes.jatengprov.go.id/m/</span>
                        <input type="text" x-model="micrositeSlug" 
                               class="flex-1 border rounded-r-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm">
                    </div>
                </div>

                <!-- Daftar Shortlink -->
                <div class="pt-6 border-t border-gray-200">
                    <h4 class="text-md font-semibold text-green-700 mb-3"> Daftar Shortlink</h4>
                    
                    <template x-for="(link, index) in links" :key="index">
                        <div class="bg-gray-50 border rounded-xl p-4 mb-3 shadow-sm">
                            <input type="text" x-model="link.title" placeholder="Judul Link" 
                                   class="w-full border rounded-lg p-2 mb-2 focus:ring-green-500 focus:border-green-500">
                            <input type="url" x-model="link.url" placeholder="URL Tujuan" 
                                   class="w-full border rounded-lg p-2 mb-2 focus:ring-green-500 focus:border-green-500">
                            <div class="flex justify-end">
                                <button type="button" 
                                        @click="links.splice(index,1)" 
                                        class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </template>
                    
                    <button type="button" 
                            @click="links.push({title: '', url: ''})" 
                            class="mt-3 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium shadow-md">
                        + Tambah Link
                    </button>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-8 border-t border-gray-200 flex justify-end">
                    <button type="submit" 
                            class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 font-semibold shadow-md">
                            Simpan Microsite
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Preview -->
        <div class="bg-gray-50 rounded-2xl shadow-inner p-8">
            <h3 class="text-xl font-semibold text-green-700 mb-6">Pratinjau Microsite</h3>
            
            <div class="bg-gradient-to-b from-green-100 to-green-200 p-8 rounded-2xl shadow-md flex flex-col items-center">
                <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" 
                     alt="Logo Dinkes" 
                     class="w-28 h-28 rounded-full shadow-lg mb-4 border-4 border-white">
                
                <h4 class="text-2xl font-bold text-gray-900 text-center" x-text="micrositeTitle"></h4>
                <p class="text-gray-600 text-center mb-6" x-text="micrositeDescription"></p>
                
                <div class="w-full max-w-xs space-y-4">
                    <template x-for="link in links" :key="link.url">
                        <a :href="link.url" target="_blank" 
                           class="block w-full bg-white shadow hover:shadow-lg rounded-xl px-4 py-3 text-center font-medium text-gray-800 hover:bg-green-50 transition">
                            <span x-text="link.title"></span>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Microsite</h1>
        <a href="{{ route('admin.microsites.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Buat Microsite Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Shortlink</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Judul</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Bidang</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Seksi</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($microsites as $m)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $m->id }}</td>
                        <td class="px-4 py-2 border-b text-blue-600">{{ $m->shortlink }}</td>
                        <td class="px-4 py-2 border-b">{{ $m->title }}</td>
                        <td class="px-4 py-2 border-b">{{ $m->bidang }}</td>
                        <td class="px-4 py-2 border-b">{{ $m->seksi }}</td>
                        <td class="px-4 py-2 border-b text-center">
                            <a href="{{ route('admin.microsites.edit', $m->id) }}" 
                               class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">Edit</a>
                            <form action="{{ route('admin.microsites.destroy', $m->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm"
                                        onclick="return confirm('Yakin hapus microsite ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada microsite</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

