<nav class="bg-white shadow border-b z-50 relative ">
    <div class="max-w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" class="h-10" alt="Logo" />
                    <div class="text-blue-600 font-bold text-xs md:text-sm leading-tight">
                        <div>DINAS KESEHATAN</div>
                        <div>PROVINSI JAWA TENGAH</div>
                    </div>
                </a>
            </div>

            {{-- User Dropdown / Hamburger --}}
            <div class="flex items-center space-x-4">
                {{-- Dropdown User (Desktop) --}}
                <div class="hidden md:block">
                    <x-dropdown aligned="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-gray-700 text-sm hover:text-blue-600">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="ml-1 w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.586l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0l-4.25-4.25a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                {{-- Hamburger (Mobile) --}}
                <div class="md:hidden">
                    <button @click="sidebarOpen = true" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
