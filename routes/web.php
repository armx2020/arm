<?php

use App\Http\Controllers\Api\CategoryForOfferController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('ip', function () {
    $ip = '109.234.28.90';
    $data = Location::get($ip);
    dd($data);
}); // TODO проверка ip пользователя (Удалить при запуски проекта)

Route::get('/{regionCode?}', [HomeController::class, 'home'])->where('regionCode', '[0-9]+|null')->name('home');

Route::name('groups.')->prefix('/groups')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::get('/{id}', [GroupController::class, 'show'])->name('show');
    Route::get('/places', [GroupController::class, 'places'])->name('places');
    Route::get('/religion', [GroupController::class, 'religion'])->name('religion');
});

Route::name('projects.')->prefix('/projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
});

Route::name('events.')->prefix('/events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{id}', [EventController::class, 'show'])->name('show');
});

Route::name('news.')->prefix('/news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{id}', [NewsController::class, 'show'])->name('show');
});

Route::name('companies.')->prefix('/companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/{id}', [CompanyController::class, 'show'])->name('show');
});

Route::name('works.')->prefix('/works')->group(function () {
    Route::get('/', [WorkController::class, 'index'])->name('index');
    Route::get('/{id}', [WorkController::class, 'show'])->name('show');
});

Route::name('region.')->prefix('/{regionCode}')->group(function () {
    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
    Route::get('/works', [WorkController::class, 'index'])->name('works');
});

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/condition-of-use', [HomeController::class, 'conditionOfUse'])->name('condition-of-use');

Route::post('/cities', [CityController::class, 'get'])->name('cities');
Route::post('/actions', [CategoryForOfferController::class, 'get'])->name('actions');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/profile.php';
