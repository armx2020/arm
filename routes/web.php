<?php

use App\Http\Controllers\Api\CategoryForOfferController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Pages\EntityController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ProfileController;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/inform-us.php';

// Route::get('/admin', function () {
//     return redirect()->route('admin.dashboard');
// });

Route::get('ip', function () {
    $ip = '109.234.28.90';
    $data = Location::get($ip);
    dd($data);
}); // TODO проверка ip пользователя (Удалить при запуски проекта)

Route::get('/companies', [EntityController::class, 'companies'])->name('companies.index');
Route::get('/groups', [EntityController::class, 'groups'])->name('groups.index');
Route::get('/places', [EntityController::class, 'places'])->name('places.index');
Route::get('/communities', [EntityController::class, 'communities'])->name('communities.index');

Route::get('/{regionTranslit?}', [HomeController::class, 'home'])->name('home');




Route::name('region.')->prefix('/{regionTranslit}')->group(function () {
    Route::get('/companies', [EntityController::class, 'companies'])->name('companies');
    Route::get('/groups', [EntityController::class, 'groups'])->name('groups');
    Route::get('/places', [EntityController::class, 'places'])->name('places');
    Route::get('/communities', [EntityController::class, 'communities'])->name('communities');
});

Route::get('/entity/{entity}', [EntityController::class, 'show'])->name('entity.show');

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/condition-of-use', [HomeController::class, 'conditionOfUse'])->name('condition-of-use');

Route::get('/cities', [CityController::class, 'get'])->name('cities');
Route::post('/actions', [CategoryForOfferController::class, 'get'])->name('actions');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/inform-us.php';
