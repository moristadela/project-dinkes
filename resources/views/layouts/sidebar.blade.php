<aside class="w-64 bg-white border-r border-gray-200 shadow-sm" x-data="{ openUser: false }">
    <div class="p-4 border-b border-gray-200">
        <h1 class="text-xl font-semibold text-blue-700">Menu</h1>
    </div>
    
    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">Dashboard</a>
        <a href="{{ route('admin.microsites.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">Microsite</a>
        
    {{-- Dropdown URLs --}}
    <div>
        <button @click="openUser = !openUser" 
            class="flex justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">
            <span>Daftar URLs</span>
            <span x-text="openUser ? '▲' : '▼'"></span>
        </button>
        <div x-show="openUser" x-cloak class="ml-4 mt-1 space-y-1">
            <a href="{{ route('admin.bidang.index') }}" class="block px-3 py-1 rounded hover:bg-blue-100 transition duration-150">Bidang</a>
            <a href="{{ route('admin.seksi.index') }}" class="block px-3 py-1 rounded hover:bg-blue-100 transition duration-150">Seksi</a>
        </div>
    </div>

        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">User Management</a>
    </nav>
</aside>