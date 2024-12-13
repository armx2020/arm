<?php

use App\Http\Controllers\InformUsController;
use Illuminate\Support\Facades\Route;


Route::get('/inform-us/{entity}', [InformUsController::class, 'index'])->name('inform-us');
Route::post('/inform-us/company', [InformUsController::class, 'storeCompany'])->name('inform-us.store.company');
