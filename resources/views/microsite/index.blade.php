@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-6" x-data="{ links: [
    { title: 'Dashboard Dinkes', url: 'https://dinkes.jatengprov.go.id' },
    { title: 'Data Covid-19', url: 'https://corona.jatengprov.go.id' }
] }">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Shortlink</h2>
        <button class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 text-sm">← Kembali</button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Form -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Pengaturan Shortlink</h3>
            
            <form class="space-y-5">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Link</label>
                    <input type="text" class="mt-1 w-full border rounded-lg p-2 focus:ring-green-500 focus:border-green-500" value="Dashboard Dinkes Jateng">
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Slug</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 rounded-l-lg text-gray-500 text-sm">https://dinkes.jatengprov.go.id/s/</span>
                        <input type="text" class="flex-1 border rounded-r-lg p-2 focus:ring-green-500 focus:border-green-500" value="dashboard">
                    </div>
                </div>

                <!-- URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">URL Tujuan</label>
                    <input type="url" class="mt-1 w-full border rounded-lg p-2 focus:ring-green-500 focus:border-green-500" value="https://dinkes.jatengprov.go.id">
                </div>

                <!-- Links Tambahan -->
                <div class="pt-4 border-t">
                    <h4 class="text-md font-semibold text-green-700 mb-3">Daftar Shortlink</h4>
                    <template x-for="(link, index) in links" :key="index">
                        <div class="bg-gray-50 border rounded-lg p-4 mb-3">
                            <input type="text" x-model="link.title" placeholder="Judul" class="w-full border rounded-lg p-2 mb-2 focus:ring-green-500 focus:border-green-500">
                            <input type="url" x-model="link.url" placeholder="URL" class="w-full border rounded-lg p-2 mb-2 focus:ring-green-500 focus:border-green-500">
                            <div class="flex items-center justify-between">
                                <button type="button" @click="links.splice(index,1)" class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">Hapus</button>
                            </div>
                        </div>
                    </template>
                    <button type="button" @click="links.push({title: '', url: ''})" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm">+ Tambah Link</button>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Preview -->
        <div>
            <h3 class="text-lg font-semibold mb-4 text-green-700">Pratinjau Shortlink</h3>
            <div class="bg-gradient-to-b from-red-100 to-red-200 p-8 rounded-2xl shadow-md flex flex-col items-center">
                <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" alt="Logo Dinkes" class="w-28 h-28 rounded-full shadow-lg mb-4">
                <h4 class="text-xl font-bold text-gray-900 text-center">Dinas Kesehatan<br>Provinsi Jawa Tengah</h4>
                <p class="text-gray-600 text-center mb-6">Kumpulan Shortlink Resmi</p>
                <div class="w-full max-w-xs space-y-4">
                    <template x-for="link in links" :key="link.url">
                        <a :href="link.url" target="_blank" class="block w-full bg-white shadow hover:shadow-lg rounded-xl px-4 py-3 text-center font-medium text-gray-800">
                            <span x-text="link.title"></span>
                        </a>
                    </template>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
