<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('dashboard');

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});



require __DIR__ . '/auth.php';
