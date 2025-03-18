<?php

use App\Http\Controllers\Api\CategoryForOfferController;
use App\Http\Controllers\Api\EntityForHomePageController;
use App\Http\Controllers\Api\CityController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', [CityController::class, 'get'])->name('cities');
Route::post('/actions', [CategoryForOfferController::class, 'get'])->name('actions');
Route::get('/entities', [EntityForHomePageController::class, 'get'])->name('entities');