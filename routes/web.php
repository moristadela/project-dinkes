<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Url;
use App\Http\Controllers\Admin\UrlShortenerController;

Route::get('/', fn () => view('welcome'));

// Dashboard user biasa
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin area
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // /admin/dashboard
        Route::get('/dashboard', function () {
            $stats = [
                'totalUser'      => 15,
                'totalBidang'    => 5,
                'totalShortlink' => 120,
            ];

            $seksi = [
                ['nama' => 'Seksi 1', 'bidang' => 'Bidang A'],
                ['nama' => 'Seksi 2', 'bidang' => 'Bidang B'],
                ['nama' => 'Seksi 3', 'bidang' => 'Bidang C'],
                ['nama' => 'Seksi 4', 'bidang' => 'Bidang D'],
                ['nama' => 'Seksi 5', 'bidang' => 'Bidang E'],
            ];

            // Ambil data URL (pakai paginate biar bisa {{ $urls->links() }})
            $urls = Url::latest()->paginate(10);

            // PASTIKAN 'urls' ikut dikirim
            return view('admin.dashboard', compact('stats', 'seksi', 'urls'));
        })->name('dashboard');

        // CRUD URL Shortener: nama route jadi admin.url.index, admin.url.create, dst.
        Route::resource('url', UrlShortenerController::class)->names('url');
    });

// Halaman statis
Route::view('/shortlink', 'shortlink')->name('shortlink');
Route::view('/microsite', 'microsite')->name('microsite');

require __DIR__.'/auth.php';
