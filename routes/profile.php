<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\MyCompanyController;
use App\Http\Controllers\Profile\MyEventController;
use App\Http\Controllers\Profile\MyGroupController;
use App\Http\Controllers\Profile\MyNewsController;
use App\Http\Controllers\Profile\MyProjectController;
use App\Http\Controllers\Profile\MyResumeController;
use App\Http\Controllers\Profile\MyOfferController;
use App\Http\Controllers\Profile\MyVacancyController;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/questions', [DashboardController::class, 'questions'])->name('questions');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Subscride for group
    Route::get('/group/{id}/subscribe', [GroupController::class, 'subscribe'])->name('group.subscribe');
    Route::get('/group/{id}/unsubscribe', [GroupController::class, 'unsubscribe'])->name('group.unsubscribe');

    Route::resources([
        'mygroups'      =>  MyGroupController::class,
        'mycompanies'   =>  MyCompanyController::class,
        'myprojects'    =>  MyProjectController::class,
        'myoffers'      =>  MyOfferController::class,
        'mynews'        =>  MyNewsController::class,
        'myevents'      =>  MyEventController::class,
        'myresumes'     =>  MyResumeController::class,
        'myvacancies'   =>  MyVacancyController::class
    ]);
});