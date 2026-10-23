<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', [HomeController::class, 'tentang']);
Route::get('/kontak', [HomeController::class, 'kontak']);

// Rute Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Blok Route Resource Buku
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);
});

// PENTING: Jangan hapus baris ini karena memuat rute profile.edit, profile.update, dll.
require __DIR__.'/auth.php';