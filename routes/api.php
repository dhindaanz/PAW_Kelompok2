<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('api.home');
