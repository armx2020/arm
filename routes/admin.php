<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\GroupCategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OfferCategoryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VacancyController;


Route::name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('dashboard');


    Route::middleware(['auth:admin', 'verified'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('company', CompanyController::class);
        Route::resource('groupCategory', GroupCategoryController::class);
        Route::resource('group', GroupController::class);
        Route::resource('offerCategory', OfferCategoryController::class);
        Route::resource('offer', OfferController::class);
        Route::resource('resume', ResumeController::class);
        Route::resource('experience', ExperienceController::class);
        Route::resource('vacancy', VacancyController::class);
        Route::resource('event', EventController::class);
        Route::resource('news', NewsController::class);
    });



    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
