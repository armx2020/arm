<?php

use App\Http\Controllers\InformUS\CompanyController;
use App\Http\Controllers\InformUS\EventController;
use App\Http\Controllers\InformUS\GroupController;
use App\Http\Controllers\InformUS\NewsController;
use App\Http\Controllers\InformUS\WorkController;
use Illuminate\Support\Facades\Route;

Route::name('inform-us.')->group(function () {

    Route::get('/inform-us/company', [CompanyController::class, 'index'])->name('company');
    Route::post('/inform-us/company', [CompanyController::class, 'store']);

    Route::get('/inform-us/group', [GroupController::class, 'index'])->name('group');
    Route::post('/inform-us/group', [GroupController::class, 'store']);

    Route::get('/inform-us/event', [EventController::class, 'index'])->name('event');
    Route::post('/inform-us/event', [EventController::class, 'store']);

    Route::get('/inform-us/new', [NewsController::class, 'index'])->name('news');
    Route::post('/inform-us/new', [NewsController::class, 'store']);

    Route::get('/inform-us/work', [WorkController::class, 'index'])->name('work');
    Route::post('/inform-us/work', [WorkController::class, 'store']);
});
