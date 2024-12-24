<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', [CityController::class, 'get'])->name('get-city');
Route::get('/users', [UserController::class, 'get'])->name('get-user');