<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UrlShortenerController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\SeksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\DaftarLinkController;


// Halaman awal
Route::get('/', fn () => view('welcome'));

// Dashboard user biasa
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup Rute Admin (disatukan)
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard (Menggunakan UserController untuk menampilkan daftar URL)
        Route::get('/dashboard', [UrlShortenerController::class, 'index'])->name('dashboard');

        // CRUD URL Shortener
        Route::resource('urls', controller: UrlShortenerController::class)->names('urls');

        // Management User
        Route::resource('users', UserController::class)->names('users');

        // Daftar Bidang & Seksi
        Route::resource('bidang', BidangController::class);
        Route::resource('seksi', SeksiController::class);
    });

// Shortlink
Route::prefix('shortlink')->name('shortlink.')->group(function () {
    Route::get('/', [UrlShortenerController::class, 'generateForm'])->name('index');
    Route::get('/create', [UrlShortenerController::class, 'create'])->name('create');
    Route::post('/generate', [UrlShortenerController::class, 'generate'])->name('generate');
    Route::post('/save', [UrlShortenerController::class, 'save'])->name('save');
    Route::get('/shortlink/{id}/edit', [UrlShortenerController::class, 'edit'])->name('shortlink.edit');
    Route::put('/shortlink/{id}', [UrlShortenerController::class, 'update'])->name('shortlink.update');

});

// Microsite
Route::view('/microsite/index', 'microsite.index')->name('microsite.index');

// Redirect short URL (PENTING: rute ini harus diletakkan di bagian paling bawah
// agar tidak bentrok dengan rute lain di atasnya)
Route::get('/{short_url}', [UrlShortenerController::class, 'redirectToOriginal'])
    ->where('short_url', '[A-Za-z0-9]+') // Pastikan hanya menerima string alfanumerik
    ->name('shortlink.redirect');

require __DIR__.'/auth.php';
