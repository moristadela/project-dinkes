<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dinkes Web') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="icon" href="https://dinkes.jatengprov.go.id/wp-content/uploads/2023/02/Logo-Provinsi-Jawa-Tengah-1-e1675238827781.png" type="image/png">
</head>

<body 
    x-data="{ sidebarOpen: false, isDesktop: window.innerWidth >= 768 }"
    x-init="
        window.addEventListener('resize', () => {
            isDesktop = window.innerWidth >= 768;
            if (isDesktop) sidebarOpen = false;
        });
    "
    class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="flex flex-1 relative">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Overlay untuk mobile --}}
        <div 
            x-show="sidebarOpen && !isDesktop"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden">
        </div>

        {{-- Main Content --}}
        <main class="flex-1 p-4 overflow-y-auto z-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
