<?php

use App\Http\Controllers\InformUsController;
use Illuminate\Support\Facades\Route;


Route::get('/inform-us/{entity}', [InformUsController::class, 'index'])->name('inform-us');
Route::post('/inform-us', [InformUsController::class, 'store'])->name('inform-us.store');
