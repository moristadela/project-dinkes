<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard default (untuk user biasa)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    // Dummy data untuk tes
    $stats = [
        'totalUser' => 15,
        'totalBidang' => 5,
        'totalShortlink' => 120,
    ];

    $seksi = [
        ['nama' => 'Seksi 1', 'bidang' => 'Bidang A'],
        ['nama' => 'Seksi 2', 'bidang' => 'Bidang B'],
        ['nama' => 'Seksi 3', 'bidang' => 'Bidang C'],
        ['nama' => 'Seksi 4', 'bidang' => 'Bidang D'],
        ['nama' => 'Seksi 5', 'bidang' => 'Bidang E'],
    ];

    return view('admin.dashboard', compact('stats', 'seksi'));
})->middleware(['auth'])->name('admin.dashboard');

Route::get('/shortlink', function () {
    return view('shortlink');
})->name('shortlink');

Route::get('/microsite', function () {
    return view('microsite');
})->name('microsite');

require __DIR__.'/auth.php';
