<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\UserController;




Route::name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('dashboard');


    Route::resource('user', UserController::class)->middleware(['auth:admin', 'verified']);
    Route::resource('company', CompanyController::class)->middleware(['auth:admin', 'verified']);



    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});