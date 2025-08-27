<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $microsite->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1f2937 0%, #0c0a09 100%);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-gray-100 p-4">
    <div class="w-full max-w-sm mx-auto p-8 rounded-2xl shadow-2xl backdrop-blur-sm bg-white/10 border border-white/20">

        <!-- Microsite Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ $microsite->title }}</h1>
            <p class="text-sm font-medium text-gray-300">
                {{ optional($microsite->bidang)->nama_bidang }} / {{ optional($microsite->seksi)->nama_seksi }}
            </p>
        </div>

        <!-- Links Section -->
        @if($microsite->links->isNotEmpty())
            <div class="space-y-4">
                @foreach($microsite->links as $link)
                    <a href="{{ $link->original_link }}" target="_blank"
                       class="block w-full px-6 py-4 bg-white/20 rounded-xl shadow-lg
                              hover:bg-white/30 transform hover:scale-105 transition-all duration-300 ease-in-out
                              font-semibold text-lg text-center">
                        {{ $link->title }}
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400">Belum ada link yang ditambahkan.</p>
        @endif

    </div>
</body>
</html>
