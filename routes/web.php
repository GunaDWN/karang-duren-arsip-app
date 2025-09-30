<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Arsip routes
    Route::resource('arsip', ArsipController::class);
    Route::get('/arsip/{id}/download', [ArsipController::class, 'download'])->name('arsip.download');
    Route::get('/api/arsip', [ArsipController::class, 'getArsip'])->name('api.arsip');
    Route::get('/api/arsip1', [ArsipController::class, 'getArsip1'])->name('api.arsip');
    Route::get('/arsip/{id}/preview', [ArsipController::class, 'preview'])->name('arsip.preview');

    // Kategori Surat routes
    Route::resource('kategori-surat', KategoriSuratController::class);
    Route::get('/api/kategori', [KategoriSuratController::class, 'getKategori'])->name('api.kategori');

    // About route
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});

require __DIR__ . '/auth.php';
