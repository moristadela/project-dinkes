<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dinkes App') }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-white border-b shadow-md">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" class="h-12 mr-3" alt="Logo" />
                <span class="text-x1 font-bold text-red-600">DINAS KESEHATAN PROVINSI JAWA TENGAH</span>
            </a>

            {{-- Menu kanan --}}
            <div class="flex items-center space-x-6">
                <a href="#" class="text-gray-600 hover:text-blue-600">Services</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Pricing</a>
                <a href="#" class="text-gray-600 hover:text-blue-600">Contact</a>
                <button class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600">
                    Sign out
                </button>
            </div>
        </div>
    </nav>

    <div class="flex flex-1">

        {{-- Sidebar --}}
        <aside class="w-64 bg-blue-50 border-r shadow-sm" x-data="{ openBidang: false }">
            <div class="p-4 border-b">
                <h1 class="text-xl font-semibold text-blue-700">Menu</h1>
            </div>
            <nav class="p-4 space-y-2">
             <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Dashboard</a>

            {{-- Dropdown Bidang 1 --}}
            <div>
                <button @click="openBidang = !openBidang" 
                    class="flex justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang
                    <span x-text="openBidang ? '▲' : '▼'"></span>
                </button>
                <div x-show="openBidang" x-cloak class="ml-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 1</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 2</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 3</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 4</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 5</a>
                </div>
            </div>

            {{-- Dropdown Bidang 2 --}}
            <div>
                <button @click="openBidang = !openBidang" 
                    class="flex justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang
                    <span x-text="openBidang ? '▲' : '▼'"></span>
                </button>
                <div x-show="openBidang" x-cloak class="ml-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 1</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 2</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 3</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 4</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 5</a>
                </div>
            </div>

            {{-- Dropdown Bidang 3--}}
            <div>
                <button @click="openBidang = !openBidang" 
                    class="flex justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang
                    <span x-text="openBidang ? '▲' : '▼'"></span>
                </button>
                <div x-show="openBidang" x-cloak class="ml-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 1</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 2</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 3</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 4</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 5</a>
                </div>
            </div>

            {{-- Dropdown Bidang 4 --}}
            <div>
                <button @click="openBidang = !openBidang" 
                    class="flex justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang
                    <span x-text="openBidang ? '▲' : '▼'"></span>
                </button>
                <div x-show="openBidang" x-cloak class="ml-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 1</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 2</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 3</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 4</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 5</a>
                </div>
            </div>

            {{-- Dropdown Bidang 5 --}}
            <div>
                <button @click="openBidang = !openBidang" 
                    class="flex justify-between items-center w-full px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">Bidang
                    <span x-text="openBidang ? '▲' : '▼'"></span>
                </button>
                <div x-show="openBidang" x-cloak class="ml-4 mt-1 space-y-1">
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 1</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 2</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 3</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 4</a>
                    <a href="#" class="block px-3 py-1 rounded hover:bg-blue-100">Seksi 5</a>
                </div>
            </div>

                    <a href="#" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-blue-100">
                        👥 User Management
                    </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6 bg-gray-50">
            @yield('content')
        </main>

    </div>
</body>
</html>
