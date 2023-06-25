<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\CityController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Middleware\FromLocation;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//  Route::get('/', function () {
//     return redirect()->route('main');
//  })->name('welcome')->middleware(FromLocation::class);

 Route::get('/', [HomeController::class, 'welcome'])->name('welcome')->middleware(FromLocation::class);
 Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware(FromLocation::class);
 Route::get('/groups', [GroupController::class, 'index'])->name('group.index')->middleware(FromLocation::class);

 Route::get('/change', [HomeController::class, 'changeCity'])->name('changeCity');

 Route::get('/groups', [GroupController::class, 'index'])->name('group.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/cities', [CityController::class, 'getCities'])->name('cities');
Route::post('/regions', [RegionController::class, 'getRegions'])->name('regions');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';