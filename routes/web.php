<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Profile\MyCompanyController;
use App\Http\Controllers\Profile\MyEventController;
use App\Http\Controllers\Profile\MyGroupController;
use App\Http\Controllers\Profile\MyNewsController;
use App\Http\Controllers\Profile\MyProjectController;
use App\Http\Controllers\Profile\MyResumeController;
use App\Http\Controllers\Profile\MyOfferController;
use App\Http\Controllers\Profile\MyWorkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/', [HomeController::class, 'welcome'])->name('welcome')->middleware(FromLocation::class);
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware(FromLocation::class);
Route::get('/groups', [GroupController::class, 'index'])->name('group.index')->middleware(FromLocation::class);

Route::get('/city/{id}', [HomeController::class, 'changeCity'])->name('changeCity');

Route::get('/groups', [GroupController::class, 'index'])->name('group.index')->middleware(FromLocation::class);
Route::get('/group/{id}', [GroupController::class, 'show'])->name('group.show')->middleware(FromLocation::class);
Route::get('/groups/places', [GroupController::class, 'places'])->name('group.places')->middleware(FromLocation::class);
Route::get('/groups/religion', [GroupController::class, 'religion'])->name('group.religion')->middleware(FromLocation::class);

Route::get('/projects', [ProjectController::class, 'index'])->name('project.index')->middleware(FromLocation::class);
Route::get('/companies', [CompanyController::class, 'index'])->name('company.index')->middleware(FromLocation::class);
Route::get('/offers', [OfferController::class, 'index'])->name('offer.index')->middleware(FromLocation::class);
Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancy.index')->middleware(FromLocation::class);
Route::get('/events', [EventController::class, 'index'])->name('event.index')->middleware(FromLocation::class);
Route::get('/news', [NewsController::class, 'index'])->name('news.index')->middleware(FromLocation::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'from'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'mygroups'      =>  MyGroupController::class,
        'mycompanies'   =>  MyCompanyController::class,
        'myprojects'    =>  MyProjectController::class,
        'myoffers'      =>  MyOfferController::class,
        'mynews'        =>  MyNewsController::class,
        'myevents'      =>  MyEventController::class,
    ]);

    Route::get('/myworks', [MyWorkController::class, 'index'])->name('myworks.index');
    Route::post('/myresume', [MyWorkController::class, 'store_resume'])->name('myresume.store');
    Route::post('/myvacancy', [MyWorkController::class, 'store_vacancy'])->name('myvacancy.store');
    Route::get('/myresume/{myresume}', [MyWorkController::class, 'show_resume'])->name('myresume.show');
    Route::get('/myvacancy/{myvacancy}', [MyWorkController::class, 'show_vacancy'])->name('myvacancy.show');
    Route::get('/myresume/{myresume}/edit', [MyWorkController::class, 'edit_resume'])->name('myresume.edit');
    Route::get('/myvacancy/{myvacancy}/edit', [MyWorkController::class, 'edit_vacancy'])->name('myvacancy.edit');
    Route::patch('/myresume/{myresume}', [MyWorkController::class, 'update_resume'])->name('myresume.update');
    Route::patch('/myvacancy/{myvacancy}', [MyWorkController::class, 'update_vacancy'])->name('myvacancy.update');
    Route::delete('/myresume/{myresume}', [MyWorkController::class, 'destroy_resume'])->name('myresume.destroy');
    Route::delete('/myvacancy/{myvacancy}', [MyWorkController::class, 'destroy_vacancy'])->name('myvacancy.destroy');
});


Route::post('/cities', [CityController::class, 'getCities'])->name('cities');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
