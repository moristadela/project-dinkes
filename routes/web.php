<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UrlShortenerController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\SeksiController;
use App\Http\Controllers\Admin\UserController;

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
        Route::resource('urls', UrlShortenerController::class)->names('urls');

        // Management User
        Route::resource('users', UserController::class)->names('users');

        // Daftar Bidang & Seksi
        Route::resource('bidang', BidangController::class);
        Route::resource('seksi', SeksiController::class); 
    });

// Shortlink
Route::get('/shortlink/index', [UrlShortenerController::class, 'generateForm'])->name('shortlink.index');
Route::post('/shortlink/generate', [UrlShortenerController::class, 'generate'])->name('shortlink.generate');
Route::post('/shortlink/save', [UrlShortenerController::class, 'save'])->name('shortlink.save');

// Microsite
Route::view('/microsite/index', 'microsite.index')->name('microsite.index');

require __DIR__.'/auth.php';
