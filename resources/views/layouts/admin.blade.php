<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">
<head>
    </head>
<body class="h-full">
    <div class="flex h-screen bg-gray-100">
        @include('layouts.admin-sidebar')

        <div class="flex-1 overflow-y-auto">
            <nav class="bg-white shadow">
                @include('layouts.admin-header')
            </nav>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>