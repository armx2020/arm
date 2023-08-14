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
        'myresumes'     =>  MyResumeController::class,
        'myoffers'      =>  MyOfferController::class,
        'mynews'        =>  MyNewsController::class,
        'myevents'      =>  MyEventController::class,
    ]);

    // Route::get('/myprojects', [MyProjectController::class, 'index'])->name('myproject.index');
    // Route::post('/myprojects', [MyProjectController::class, 'store'])->name('myproject.store');
    // Route::get('/myprojects/{id}', [MyProjectController::class, 'show'])->name('myproject.show');
    // Route::get('/myprojects/{id}/edit', [MyProjectController::class, 'edit'])->name('myproject.edit');
    // Route::patch('/myprojects/{id}', [MyProjectController::class, 'update'])->name('myproject.update');
    // Route::delete('/myprojects/{id}', [MyProjectController::class, 'destroy'])->name('myproject.destroy');

    // Route::get('/myresumes', [MyResumeController::class, 'index'])->name('myresume.index');
    // Route::post('/myresumes', [MyResumeController::class, 'store'])->name('myresume.store');
    // Route::get('/myresumes/{id}', [MyResumeController::class, 'show'])->name('myresume.show');
    // Route::get('/myresumes/{id}/edit', [MyResumeController::class, 'edit'])->name('myresume.edit');
    // Route::patch('/myresumes/{id}', [MyResumeController::class, 'update'])->name('myresume.update');
    // Route::delete('/myresumes/{id}', [MyResumeController::class, 'destroy'])->name('myresume.destroy');
});


Route::post('/cities', [CityController::class, 'getCities'])->name('cities');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
