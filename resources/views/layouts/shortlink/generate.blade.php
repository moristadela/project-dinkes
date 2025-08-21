<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortlink</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="min-h-screen flex flex-col">
    
    {{-- Navbar --}}
    @include('layouts.navbar')

    <div class="flex flex-1">
        {{-- Sidebar --}}
        @include('layouts.sidebar')
        
        {{-- Main Content --}}
        <main class="flex-1 p-0">
            @yield('content')
        </main>
    </div>
</body>
</html>