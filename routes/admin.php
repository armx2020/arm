<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\GroupCategoryController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OfferCategoryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VacancyController;


Route::name('admin.')->prefix('admin')->group(function () {

    Route::middleware(['auth:admin', 'verified'])->group(function () {
        
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resources([
            'user'          =>  UserController::class,
            'company'       =>  CompanyController::class,
            'groupCategory' =>  GroupCategoryController::class,
            'group'         =>  GroupController::class,
            'offerCategory' =>  OfferCategoryController::class,
            'offer'         =>  OfferController::class,
            'resume'        =>  ResumeController::class,
            'experience'    =>  ExperienceController::class,
            'vacancy'       =>  VacancyController::class,
            'event'         =>  EventController::class,
            'news'          =>  NewsController::class,
            'project'       =>  ProjectController::class
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
