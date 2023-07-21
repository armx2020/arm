<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Profile\GroupController as ProfileGroupController;
use App\Http\Controllers\Profile\MyCompanyController;
use App\Http\Controllers\Profile\MyGroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\VacancyController;
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

 Route::get('/groups', [GroupController::class, 'index'])->name('group.index')->middleware(FromLocation::class);
 Route::get('/group/{id}', [GroupController::class, 'show'])->name('group.show')->middleware(FromLocation::class);
 
 Route::get('/projects' , [ProjectController::class, 'index'])->name('project.index')->middleware(FromLocation::class);
 Route::get('/companies' , [CompanyController::class, 'index'])->name('company.index')->middleware(FromLocation::class);
 Route::get('/offers' , [OfferController::class, 'index'])->name('offer.index')->middleware(FromLocation::class);
 Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancy.index')->middleware(FromLocation::class);
 Route::get('/events', [EventController::class, 'index'])->name('event.index')->middleware(FromLocation::class);
 Route::get('/news', [NewsController::class, 'index'])->name('news.index')->middleware(FromLocation::class);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'from'])->name('dashboard');



Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Group
    Route::get('/mygroups', [MyGroupController::class, 'index'])->name('mygroup.index');
    Route::post('/mygroups', [MyGroupController::class, 'store'])->name('mygroup.store');
    Route::get('/mygroups/{id}', [MyGroupController::class, 'show'])->name('mygroup.show');
    Route::get('/mygroups/{id}/edit', [MyGroupController::class, 'edit'])->name('mygroup.edit');
    Route::patch('/mygroups/{id}', [MyGroupController::class, 'update'])->name('mygroup.update');
    Route::delete('/mygroups/{id}', [MyGroupController::class, 'destroy'])->name('mygroup.destroy');

    // Company
    Route::get('/mycompanies', [MyCompanyController::class, 'index'])->name('mycompany.index');
    Route::post('/mycompanies', [MyCompanyController::class, 'store'])->name('mycompany.store');
    Route::get('/mycompanies/{id}', [MyCompanyController::class, 'show'])->name('mycompany.show');
    Route::get('/mycompanies/{id}/edit', [MyCompanyController::class, 'edit'])->name('mycompany.edit');
    Route::patch('/mycompanies/{id}', [MyCompanyController::class, 'update'])->name('mycompany.update');
    Route::delete('/mycompanies/{id}', [MyCompanyController::class, 'destroy'])->name('mycompany.destroy');
});


Route::post('/cities', [CityController::class, 'getCities'])->name('cities');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';