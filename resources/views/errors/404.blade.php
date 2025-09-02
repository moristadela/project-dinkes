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
<body class="bg-gradient-to-br from-green-50 to-blue-100 min-h-screen flex items-center justify-center text-gray-800 p-4">
    
    <div class="w-full max-w-sm mx-auto p-8 rounded-2xl shadow-xl bg-white border border-gray-200 transform transition-transform duration-300 hover:scale-[1.01]">
        
        {{-- Logo --}}
        <div class="flex justify-center gap-x-4 mb-8">
            <img src="https://jatengprov.go.id/wp-content/uploads/2025/02/logo-jateng-ngopeni-nglakoni.png" 
                 alt="Logo Jateng Ngopeni" 
                 class="w-36 h-20 sm:w-36 sm:h-24 shadow-md rounded-lg transform transition-transform duration-300 hover:scale-110">
            
            <img src="https://magang.dinkesjatengprov.go.id/img/dinkes.png" 
                 alt="Logo Dinas Kesehatan" 
                 class="w-20 h-20 sm:w-24 sm:h-24 shadow-md rounded-lg transform transition-transform duration-300 hover:scale-110">
        </div>

        {{-- Icon 404 --}}
        <h1 class="text-6xl font-extrabold text-blue-600 mb-3 text-center">404</h1>
        <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Halaman Tidak Ditemukan</h2>
        
        {{-- Pesan --}}
        <p class="text-gray-500 mb-6 text-center">
            Oops! Shortlink yang kamu akses tidak tersedia atau sudah dihapus.
        </p>

        <!-- {{-- Button --}}
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ url('/') }}" 
            class="link-card flex items-center justify-center px-6 py-3 w-full sm:w-auto bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-xl font-semibold text-center hover:from-blue-100 hover:to-blue-200">
                Kembali ke Beranda
            </a>
            <a href="{{ url()->previous() }}" 
            class="link-card flex items-center justify-center px-6 py-3 w-full sm:w-auto bg-gradient-to-r from-green-50 to-green-100 text-green-700 rounded-xl font-semibold text-center hover:from-green-100 hover:to-green-200">
                Kembali
            </a>
        </div> -->

    </div>

</body>
</html>
