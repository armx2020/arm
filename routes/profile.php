<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Profile\MyProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\MyCompanyController;
use App\Http\Controllers\Profile\MyEventController;
use App\Http\Controllers\Profile\MyGroupController;
use App\Http\Controllers\Profile\MyNewsController;
use App\Http\Controllers\Profile\MyProjectController;
use App\Http\Controllers\Profile\MyOfferController;
use App\Http\Controllers\Profile\MyWorksController;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/questions', [DashboardController::class, 'questions'])->name('questions');

    // Profile
    Route::get('/profile', [MyProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [MyProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [MyProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'mygroups'      =>  MyGroupController::class,
        'mycompanies'   =>  MyCompanyController::class,
        'myprojects'    =>  MyProjectController::class,
        'myoffers'      =>  MyOfferController::class,
        'mynews'        =>  MyNewsController::class,
        'myevents'      =>  MyEventController::class,
        'myworks'       =>  MyWorksController::class,
    ]);
});