<aside 
    x-show="sidebarOpen || isDesktop"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed md:relative inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform md:translate-x-0 md:flex md:flex-col transition-transform duration-300 ease-in-out
           md:my-4 md:ml-4 md:rounded-r-3xl"
    style="display: none;"
>
    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="{{ route('admin.urls.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg transition hover:bg-blue-100
            @if(request()->routeIs('admin.urls.index')) bg-blue-100 text-blue-800 font-semibold @else text-gray-700 @endif">
            <i class="fas fa-tachometer-alt w-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.microsites.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg transition hover:bg-blue-100
            @if(request()->routeIs('admin.microsites.index')) bg-blue-100 text-blue-800 font-semibold @else text-gray-700 @endif">
            <i class="fas fa-list-alt w-5"></i>
            <span>Microsite</span>
        </a>

        @role('admin')
        <a href="{{ route('admin.bidang.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg transition hover:bg-blue-100
            @if(request()->routeIs('admin.bidang.index')) bg-blue-100 text-blue-800 font-semibold @else text-gray-700 @endif">
            <i class="fas fa-building w-5"></i>
            <span>Daftar Bidang</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg transition hover:bg-blue-100
            @if(request()->routeIs('admin.users.index')) bg-blue-100 text-blue-800 font-semibold @else text-gray-700 @endif">
            <i class="fas fa-users-cog w-5"></i>
            <span>User Management</span>
        </a>
        @endrole
    </nav>
</aside>
