{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://dinkes.jatengprov.go.id/wp-content/uploads/2023/02/Logo-Provinsi-Jawa-Tengah-1-e1675238827781.png">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-100 min-h-screen flex items-center justify-center text-gray-800 p-4">
    
    <div class="w-full max-w-md mx-auto p-8 rounded-2xl shadow-xl bg-white border border-gray-200 text-center">
        
        {{-- Logo --}}
        <div class="flex justify-center gap-x-4 mb-8">
            <img src="https://jatengprov.go.id/wp-content/uploads/2025/02/logo-jateng-ngopeni-nglakoni.png" 
                 alt="Logo Jateng Ngopeni" 
                 class="w-16 h-16 sm:w-20 sm:h-20 shadow-md rounded-lg">
            
            <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" 
                 alt="Logo Dinas Kesehatan" 
                 class="w-16 h-16 sm:w-20 sm:h-20 shadow-md rounded-lg">
        </div>

        {{-- Icon 404 --}}
        <h1 class="text-6xl font-extrabold text-blue-600 mb-3">404</h1>
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Halaman Tidak Ditemukan</h2>
        
        {{-- Pesan --}}
        <p class="text-gray-500 mb-6">
            Oops! Shortlink yang kamu akses tidak tersedia atau sudah dihapus.
        </p>

        {{-- Tombol --}}
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ url('/') }}" 
               class="px-6 py-3 bg-blue-400 text-white font-semibold rounded-xl shadow hover:opacity-90 transition">
                Kembali ke Beranda
            </a>
            <a href="{{ url()->previous() }}" 
               class="px-6 py-3 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 font-medium rounded-xl shadow hover:from-blue-100 hover:to-blue-200 transition">
                Kembali
            </a>
        </div>
    </div>

</body>
</html>
