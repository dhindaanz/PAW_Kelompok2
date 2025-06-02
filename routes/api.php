<?php

use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('api.home');

Route::post('/login', LoginController::class)->name('api.login');

Route::get('/buku', [BukuController::class, 'index'])->name('api.buku.index');
Route::post('/buku', [BukuController::class, 'store'])->name('api.buku.store');
Route::get('/buku/{id}', [BukuController::class, 'show'])->name('api.buku.show');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('api.buku.update');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('api.buku.destroy');

Route::get('/kategori', [KategoriController::class, 'index'])->name('api.kategori.index');
Route::post('/kategori', [KategoriController::class, 'store'])->name('api.kategori.store');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('api.kategori.show');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('api.kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('api.kategori.destroy');
