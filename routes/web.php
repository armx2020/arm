<?php

use App\Http\Controllers\Api\CategoryForOfferController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Pages\CommunityController;
use App\Http\Controllers\Pages\CompanyController;
use App\Http\Controllers\Pages\EntityController;
use App\Http\Controllers\Pages\GroupController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\JobController;
use App\Http\Controllers\Pages\PlaceController;
use App\Http\Controllers\Pages\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/inform-us.php';


Route::get('/companies/{category?}/{subCategory?}', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/groups/{category?}/{subCategory?}', [GroupController::class, 'index'])->name('groups.index');
Route::get('/places/{category?}/{subCategory?}', [PlaceController::class, 'index'])->name('places.index');
Route::get('/communities/{category?}/{subCategory?}', [CommunityController::class, 'index'])->name('communities.index');
Route::get('/jobs/{category?}/{subCategory?}', [JobController::class, 'index'])->name('jobs.index');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/condition-of-use', [HomeController::class, 'conditionOfUse'])->name('condition-of-use');

Route::get('/cities', [CityController::class, 'get'])->name('cities');
Route::post('/actions', [CategoryForOfferController::class, 'get'])->name('actions');

Route::get('/company/{idOrTranscript}', [EntityController::class, 'company'])->name('company.show');
Route::get('/group/{idOrTranscript}', [EntityController::class, 'group'])->name('group.show');
Route::get('/place/{idOrTranscript}', [EntityController::class, 'place'])->name('place.show');
Route::get('/community/{idOrTranscript}', [EntityController::class, 'community'])->name('community.show');
Route::get('/job/{idOrTranscript}', [EntityController::class, 'job'])->name('job.show');

Route::get('/edit/{idOrTranscript}', [EntityController::class, 'edit'])->name('entity.edit');
Route::patch('/{idOrTranscript}', [EntityController::class, 'update'])->name('entity.update');

Route::get('/photo/{idOrTranscript}', [EntityController::class, 'editPhoto'])->name('entity.photo.edit');
Route::patch('/photo/{idOrTranscript}', [EntityController::class, 'updatePhoto'])->name('entity.photo.update');

Route::get('/{regionTranslit?}', [HomeController::class, 'home'])->name('home');


Route::name('region.')->prefix('/{regionTranslit}')->group(function () {
    Route::get('/companies/{category?}/{subCategory?}', [CompanyController::class, 'region'])->name('companies');
    Route::get('/groups/{category?}/{subCategory?}', [GroupController::class, 'region'])->name('groups');
    Route::get('/places/{category?}/{subCategory?}', [PlaceController::class, 'region'])->name('places');
    Route::get('/communities/{category?}/{subCategory?}', [CommunityController::class, 'region'])->name('communities');
    Route::get('/jobs/{category?}/{subCategory?}', [JobController::class, 'region'])->name('jobs');
});



Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');
