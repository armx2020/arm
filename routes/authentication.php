<?php

use App\Http\Controllers\Authentication\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/register_phone', [RegisterController::class, 'store_with_phone'])->name('register_phone.store');