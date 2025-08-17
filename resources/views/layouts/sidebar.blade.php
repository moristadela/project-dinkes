<div class="flex flex-1">
    <aside class="w-64 bg-blue-50 border-r shadow-sm" x-data="{ openSekretariat: false, openKesmas: false, openPelkes: false, openP2P: false, openSDK: false }">
    <div class="p-4 border-b">
        <h1 class="text-xl font-semibold text-blue-700">Menu</h1>
    </div>
    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Dashboard</a>

        {{-- Dropdown Bidang Sekretariat--}}
        <div>
            <button @click="openSekretariat = !openSekretariat" 
                class="flex text-left justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang Sekretariat
                <span x-text="openSekretariat ? '▲' : '▼'"></span>
            </button>
            <div x-show="openSekretariat" x-cloak class="ml-4 mt-1 space-y-1">
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Sub Bagian Umum & Kepegawaian</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Sub Bagian Program</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Sub Bagian Keuangan</a>
            </div>
        </div>

        {{-- Dropdown Bidang Kesehatan Masyarakat --}}
        <div>
            <button @click="openKesmas = !openKesmas" 
                class="flex text-left justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang Kesehatan Masyarakat
                <span x-text="openKesmas ? '▲' : '▼'"></span>
            </button>
            <div x-show="openKesmas" x-cloak class="ml-4 mt-1 space-y-1">
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Kesehatan Keluarga dan Gizi</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Promosi Kesehatan dan Pemberdayaan Masyarakat</a>
                <a href="#" class="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Kesehatan Lingkungan, Kesehatan Kerja dan Olahraga</a>
            </div>
        </div>

        {{-- Dropdown Bidang Pelayanan Kesehatan--}}
        <div>
            <button @click="openPelkes = !openPelkes" 
                class="flex text-left justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang Pelayanan Kesehatan
                <span x-text="openPelkes ? '▲' : '▼'"></span>
            </button>
            <div x-show="openPelkes" x-cloak class="ml-4 mt-1 space-y-1">
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Pelayanan Kesehatan Primer dan Kesehatan Tradisional</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Standarisasi Pelayanan dan Jaminan Kesehatan</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Pelayanan Kesehatan Rujukan</a>
            </div>
        </div>

        {{-- Dropdown Bidang Pencegahan dan Pengendalian Penyakit --}}
        <div>
            <button @click="openP2P = !openP2P" 
                class="flex text-left justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang Pencegahan & Pengendalian Penyakit
                <span x-text="openP2P ? '▲' : '▼'"></span>
            </button>
            <div x-show="openP2P" x-cloak class="ml-4 mt-1 space-y-1">
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Surveilans dan Imunisasi</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Pencegahan dan Pengendalian Penyakit Menular</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Pencegahan dan Pengendalian Penyakit Tidak Menular dan Kesehatan Jiwa</a>
            </div>
        </div>

        {{-- Dropdown Bidang Sumber Daya Kesehatan --}}
        <div>
            <button @click="openSDK = !openSDK" 
                class="flex text-left justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang Sumber Daya Kesehatan
                <span x-text="openSDK ? '▲' : '▼'"></span>
            </button>
            <div x-show="openSDK" x-cloak class="ml-4 mt-1 space-y-1">
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Manajemen Informasi Kesehatan</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Sumber Daya Manusia Kesehatan</a>
                <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi Farmasi, Makanan Minuman dan Perbekalan Kesehatan</a>
            </div>
        </div>

        <a href="#" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">User Management</a>
    </nav>
</aside>
</div>