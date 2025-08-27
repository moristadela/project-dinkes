<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UrlShortenerController;
use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\SeksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\DaftarLinkController;
use App\Http\Controllers\Admin\MicrositeController;


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

// Grup Rute Admin
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [UrlShortenerController::class, 'index'])->name('dashboard');

        // CRUD URL Shortener
        Route::resource('urls', UrlShortenerController::class)->names('urls');

        // Management User
        Route::resource('users', UserController::class)->names('users');

        // Daftar Bidang & Seksi
        Route::resource('bidang', BidangController::class);
        Route::resource('seksi', SeksiController::class);

        // Microsites
        Route::resource('microsites', MicrositeController::class)
            ->names('microsites');
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
// Route::view('/microsite/index', 'microsite.index')->name('microsite.index');

require __DIR__.'/auth.php';

// Rute untuk menampilkan microsite
Route::get('/m/{shortlink}', [MicrositeController::class, 'show'])->name('microsite.show');

// Redirect short URL
Route::get('/{short_url}', [UrlShortenerController::class, 'redirectToOriginal'])
    ->where('short_url', '^(?!login$|register$|logout$|dashboard$)[A-Za-z0-9]+')
    ->name('shortlink.redirect');

