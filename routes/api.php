<?php

use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('api.home');

Route::get('/buku', [BukuController::class, 'index'])->name('api.buku.index');
Route::post('/buku', [BukuController::class, 'store'])->name('api.buku.store');
Route::get('/buku/{id}', [BukuController::class, 'show'])->name('api.buku.show');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('api.buku.update');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('api.buku.destroy');
