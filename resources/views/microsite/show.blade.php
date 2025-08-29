<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $microsite->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://dinkes.jatengprov.go.id/wp-content/uploads/2023/02/Logo-Provinsi-Jawa-Tengah-1-e1675238827781.png">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Warna biru terang untuk nuansa formal */
            background-color: #ffffffff; 
        }
        .link-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .link-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-gray-800 p-4">
    <div class="w-full max-w-sm mx-auto p-8 rounded-2xl shadow-xl bg-white border border-gray-200 transform transition-transform duration-300 hover:scale-105">

        {{-- Logo --}}
        <div class="flex justify-center mb-8">
            <!-- Ganti URL placeholder dengan URL logo Dinas Kesehatan Anda -->
             <img src="https://jatengprov.go.id/wp-content/uploads/2025/02/logo-jateng-ngopeni-nglakoni.png" alt="Logo Jateng Ngopeni" class="w-32 h-32 shadow-lg border-4 border-white transform transition-transform duration-300 hover:scale-110">
            <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" alt="Logo Dinas Kesehatan" class="w-32 h-32 rounded-full shadow-lg border-4 border-white transform transition-transform duration-300 hover:scale-110">
        </div>

        <!-- Microsite Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-2 text-gray-900">{{ $microsite->title }}</h1>
            <p class="text-sm font-medium text-gray-500">
                {{-- Gunakan pengecekan untuk menghindari error jika bidang atau seksi null --}}
                {{ optional($microsite->bidang)->nama_bidang ?? 'Tidak Ada Bidang' }} / {{ optional($microsite->seksi)->nama_seksi ?? 'Tidak Ada Seksi' }}
            </p>
        </div>

        <!-- Links Section -->
        @if($microsite->daftarLinks->isNotEmpty())
            <div class="space-y-4">
                @foreach($microsite->daftarLinks as $link)
                    <a href="{{ $link->original_link }}" target="_blank"
                    class="link-card block w-full px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-xl font-semibold text-lg text-center border-b-2 border-blue-200">
                        {{ $link->title }}
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada link yang ditambahkan.</p>
        @endif


    </div>
</body>
</html>
