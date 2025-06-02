<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\BukuController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\KategoriController;
use App\Http\Controllers\Dashboard\PengembalianController;
use App\Http\Controllers\Dashboard\RiwayatPeminjamanController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('dashboard');

    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{id}/detail', [BukuController::class, 'show'])->name('buku.show');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{id}/detail', [KategoriController::class, 'show'])->name('kategori.show');

    Route::get('/peminjaman', [RiwayatPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [RiwayatPeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [RiwayatPeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');

    Route::middleware('is_admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });
});
