<aside class="w-64 bg-white border-r border-gray-200 shadow-sm" x-data="{ openUser: false }">
    <div class="p-4 border-b border-gray-200">
        <h1 class="text-xl font-semibold text-blue-700">Menu</h1>
    </div>
    
    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">Dashboard</a>
        <a href="{{ route(name: 'admin.microsites.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">Microsite</a>
        <a href="{{ route(name: 'admin.bidang.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">Daftar Bidang</a>


        <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100 transition duration-150">User Management</a>
    </nav>
</aside>