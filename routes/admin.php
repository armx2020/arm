<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VacancyController;


Route::name('admin.')->prefix('admin')->group(function () {

    Route::middleware(['auth:admin', 'verified'])->group(function () {
        
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('user', UserController::class)->except([
            'show'
        ]);
        Route::resource('company', CompanyController::class)->except([
            'show'
        ]);
        Route::resource('category', CategoryController::class)->except([
            'show'
        ]);
        Route::resource('group', GroupController::class)->except([
            'show'
        ]);
        Route::resource('resume', ResumeController::class)->except([
            'show'
        ]);
        Route::resource('offer', OfferController::class)->except([
            'show'
        ]);
        Route::resource('vacancy', VacancyController::class)->except([
            'show'
        ]);
        Route::resource('event', EventController::class)->except([
            'show'
        ]);
        Route::resource('new', NewsController::class)->except([
            'show'
        ]);
        Route::resource('project', ProjectController::class)->except([
            'show'
        ]);
              
    });


    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
