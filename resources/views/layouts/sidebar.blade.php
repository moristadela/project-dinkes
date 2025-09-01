<aside x-show="sidebarOpen"
       x-transition:enter="transition-transform ease-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transition-transform ease-in duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       @click.away="sidebarOpen = false"
       class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform md:relative md:flex md:translate-x-0 md:flex-col md:rounded-r-3xl my-4 ml-4">
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        {{-- Dashboard (Tampilkan untuk semua peran) --}}
        <a href="{{ route('admin.urls.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-xl transition duration-150 transform hover:scale-105
            @if(request()->routeIs('admin.urls.index'))
                text-blue-800 bg-blue-100 font-semibold
            @else
                text-gray-700 hover:bg-green-100 hover:text-green-800
            @endif">
            <i class="fas fa-tachometer-alt w-5"></i>
            <span>Dashboard</span>
        </a>
        
        {{-- Microsite (Tampilkan hanya untuk admin dan user) --}}
        @hasanyrole('admin|user')
        <a href="{{ route('admin.microsites.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-xl transition duration-150 transform hover:scale-105
            @if(request()->routeIs('admin.microsites.index'))
                text-blue-800 bg-blue-100 font-semibold
            @else
                text-gray-700 hover:bg-green-100 hover:text-green-800
            @endif">
            <i class="fas fa-list-alt w-5"></i>
            <span>Microsite</span>
        </a>
        @endhasanyrole

        {{-- Daftar Bidang (Tampilkan hanya untuk admin) --}}
        @role('admin')
        <a href="{{ route('admin.bidang.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-xl transition duration-150 transform hover:scale-105
            @if(request()->routeIs('admin.bidang.index'))
                text-blue-800 bg-blue-100 font-semibold
            @else
                text-gray-700 hover:bg-green-100 hover:text-green-800
            @endif">
            <i class="fas fa-building w-5"></i>
            <span>Daftar Bidang</span>
        </a>
        @endrole

        {{-- User Management (Tampilkan hanya untuk admin) --}}
        @role('admin')
        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-2 px-3 py-2 rounded-xl transition duration-150 transform hover:scale-105
            @if(request()->routeIs('admin.users.index'))
                text-blue-800 bg-blue-100 font-semibold
            @else
                text-gray-700 hover:bg-green-100 hover:text-green-800
            @endif">
            <i class="fas fa-users-cog w-5"></i>
            <span>User Management</span>
        </a>
        @endrole
    </nav>
</aside>
