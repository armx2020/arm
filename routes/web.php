<?php

use App\Http\Controllers\Api\CategoryForOfferController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Pages\EntityController;
use App\Http\Controllers\Pages\EntityWithCategoryAndRegionController;
use App\Http\Controllers\Pages\EntityWithCategoryController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/inform-us.php';

Route::get('/companies', [EntityController::class, 'companies'])->name('companies.index');
Route::get('/groups', [EntityController::class, 'groups'])->name('groups.index');
Route::get('/places', [EntityController::class, 'places'])->name('places.index');
Route::get('/communities', [EntityController::class, 'communities'])->name('communities.index');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/condition-of-use', [HomeController::class, 'conditionOfUse'])->name('condition-of-use');

Route::get('/cities', [CityController::class, 'get'])->name('cities');
Route::post('/actions', [CategoryForOfferController::class, 'get'])->name('actions');

Route::get('/companies/{category}', [EntityWithCategoryController::class, 'companies'])->name('companies.category.index');
Route::get('/groups/{category}', [EntityWithCategoryController::class, 'groups'])->name('groups.category.index');
Route::get('/places/{category}', [EntityWithCategoryController::class, 'places'])->name('places.category.index');
Route::get('/communities/{category}', [EntityWithCategoryController::class, 'communities'])->name('communities.category.index');

Route::get('/company/{idOrTranscript}', [EntityController::class, 'company'])->name('company.show');
Route::get('/group/{idOrTranscript}', [EntityController::class, 'group'])->name('group.show');
Route::get('/place/{idOrTranscript}', [EntityController::class, 'place'])->name('place.show');
Route::get('/community/{idOrTranscript}', [EntityController::class, 'community'])->name('community.show');

Route::get('/edit/{idOrTranscript}', [EntityController::class, 'edit'])->name('entity.edit');
Route::patch('/{idOrTranscript}', [EntityController::class, 'update'])->name('entity.update');

Route::get('/photo/{idOrTranscript}', [EntityController::class, 'editPhoto'])->name('entity.photo.edit');
Route::patch('/photo/{idOrTranscript}', [EntityController::class, 'updatePhoto'])->name('entity.photo.update');

Route::get('/{regionTranslit?}', [HomeController::class, 'home'])->name('home');


Route::name('region.')->prefix('/{regionTranslit}')->group(function () {
    Route::get('/companies', [EntityController::class, 'companies'])->name('companies');
    Route::get('/groups', [EntityController::class, 'groups'])->name('groups');
    Route::get('/places', [EntityController::class, 'places'])->name('places');
    Route::get('/communities', [EntityController::class, 'communities'])->name('communities');

    Route::get('/companies/{category}', [EntityWithCategoryAndRegionController::class, 'companies'])->name('companies.category.index');
    Route::get('/groups/{category}', [EntityWithCategoryAndRegionController::class, 'groups'])->name('groups.category.index');
    Route::get('/places/{category}', [EntityWithCategoryAndRegionController::class, 'places'])->name('places.category.index');
    Route::get('/communities/{category}', [EntityWithCategoryAndRegionController::class, 'communities'])->name('communities.category.index');
});

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');
