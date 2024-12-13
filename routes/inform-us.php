<?php

use App\Http\Controllers\InformUS\CompanyController;
use Illuminate\Support\Facades\Route;

Route::name('inform-us.')->group(function () {
    Route::get('/inform-us/company', [CompanyController::class, 'index'])->name('company');
    Route::post('/inform-us/company', [CompanyController::class, 'store']);
});
