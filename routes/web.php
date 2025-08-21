<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UrlShortenerController;
use App\Models\Url;

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

// ADMIN
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard (pakai controller supaya data selalu ada)
        Route::get('/dashboard', [UrlShortenerController::class, 'index'])->name('dashboard');

        // CRUD URL Shortener (otomatis bikin create, store, edit, update, destroy, dll)
        Route::resource('urls', UrlShortenerController::class)->names('urls');
    });

// Shortlink
Route::get('/shortlink/index', [UrlShortenerController::class, 'generateForm'])->name('shortlink.index');
Route::post('/shortlink/generate', [UrlShortenerController::class, 'generate'])->name('shortlink.generate');
Route::post('/shortlink/save', [UrlShortenerController::class, 'save'])->name('shortlink.save');


// Halaman statis lain
Route::view('/microsite/index', 'microsite.index')->name('microsite.index');
Route::view('/manageuser/index', 'manageuser.index')->name('manageuser.index');

require __DIR__.'/auth.php';
