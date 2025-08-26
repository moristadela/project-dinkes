@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6" 
      x-data="{ 
          micrositeTitle: '', 
          micrositeDescription: 'Kumpulan Shortlink Resmi',
          micrositeSlug: '',
          bidangId: '',
          seksiId: '',
          links: [
              { title: 'Dashboard Dinkes', url: 'https://dinkes.jatengprov.go.id' },
              { title: 'Data Covid-19', url: 'https://corona.jatengprov.go.id' }
          ],
          
          // Data untuk dropdown dari server
          allBidang: @json($allBidang),
          seksiList: []
      }"
      x-init="() => {
          // Log data untuk debugging, pastikan strukturnya benar
          console.log('Data Bidang dengan Seksi:', this.allBidang);

          // Gunakan $watch untuk mendengarkan perubahan pada bidangId
          $watch('bidangId', value => {
              // Cari bidang yang cocok dengan ID
              let bidang = allBidang.find(b => b.id == value);
              // Perbarui daftar seksi
              seksiList = bidang ? bidang.seksi : [];
              // Reset seksiId ketika bidang berubah
              seksiId = ''; 
              // Log daftar seksi yang difilter
              console.log('Daftar Seksi yang difilter:', seksiList);
          });
      }">

    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Buat Microsite Baru</h2>
        <a href="{{ route('admin.microsites.index') }}" 
           class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-sm font-medium">
            ← Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kolom Form -->
        <div class="bg-white shadow-lg rounded-2xl p-8 space-y-8 border border-gray-100">
            <h3 class="text-xl font-semibold text-green-700">Pengaturan Microsite</h3>
            
            <form action="{{ route('admin.microsites.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Microsite</label>
                    <input type="text" name="title" x-model="micrositeTitle" required
                           class="mt-1 w-full border rounded-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm">
                </div>
                
                <!-- Slug (Shortlink) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Slug</label>
                    <div class="flex mt-1">
                        <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 rounded-l-xl text-gray-500 text-sm">/m/</span>
                        <input type="text" name="shortlink" x-model="micrositeSlug" required
                               class="flex-1 border rounded-r-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm">
                    </div>
                </div>

                <!-- Bidang (Dropdown) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Bidang</label>
                    <select name="bidang" x-model="bidangId" required
                            class="mt-1 w-full border rounded-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm">
                        <option value="">Pilih Bidang</option>
                        {{-- Menggunakan Blade untuk mengisi dropdown Bidang --}}
                        @foreach ($allBidang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_bidang }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Seksi (Dropdown dinamis) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Seksi</label>
                    <select name="seksi" x-model="seksiId" required
                            class="mt-1 w-full border rounded-xl p-3 focus:ring-green-500 focus:border-green-500 shadow-sm"
                            :disabled="!bidangId">
                        <option value="">Pilih Seksi</option>
                        {{-- Menampilkan pesan "Tidak ada seksi" jika daftar kosong --}}
                        <template x-if="seksiList.length === 0 && bidangId !== ''">
                            <option value="" disabled>Tidak ada seksi</option>
                        </template>
                        {{-- Menggunakan Alpine.js untuk mengisi dropdown Seksi --}}
                        <template x-for="s in seksiList" :key="s.id">
                            <option :value="s.id" x-text="s.nama_seksi"></option>
                        </template>
                    </select>
                </div>

                <!-- Daftar Shortlink -->
                <div class="pt-6 border-t border-gray-200">
                    <h4 class="text-md font-semibold text-green-700 mb-3">Daftar Shortlink</h4>
                    
                    <template x-for="(link, index) in links" :key="index">
                        <div class="bg-gray-50 border rounded-xl p-4 mb-3 shadow-sm">
                            <input type="text" name="links[][title]" x-model="link.title" placeholder="Judul Link" 
                                   class="w-full border rounded-lg p-2 mb-2 focus:ring-green-500 focus:border-green-500">
                            <input type="url" name="links[][url]" x-model="link.url" placeholder="URL Tujuan" 
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
