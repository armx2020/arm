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
use App\Http\Controllers\Profile\MyVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('ip', function () {
    $ip = '109.234.28.90';
    $data = Location::get($ip);
    dd($data);
});

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

Route::name('offers.')->prefix('/offers')->group(function () {
    Route::get('/', [OfferController::class, 'index'])->name('index');
    Route::get('/{id}', [OfferController::class, 'show'])->name('show');
});

Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancy.index');
Route::get('/vacancy/{id}', [VacancyController::class, 'show_vacancy'])->name('vacancy.show');
Route::get('/resume/{id}', [VacancyController::class, 'show_resume'])->name('resume.show');

Route::get('/user/{id}', [ProfileController::class, 'show'])->name('user.show');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/condition-of-use', [HomeController::class, 'conditionOfUse'])->name('condition-of-use');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/questions', [DashboardController::class, 'questions'])->name('questions');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Subscride for group
    Route::get('/group/{id}/subscribe', [GroupController::class, 'subscribe'])->name('group.subscribe');
    Route::get('/group/{id}/unsubscribe', [GroupController::class, 'unsubscribe'])->name('group.unsubscribe');

    Route::resources([
        'mygroups'      =>  MyGroupController::class,
        'mycompanies'   =>  MyCompanyController::class,
        'myprojects'    =>  MyProjectController::class,
        'myoffers'      =>  MyOfferController::class,
        'mynews'        =>  MyNewsController::class,
        'myevents'      =>  MyEventController::class,
        'myresumes'     =>  MyResumeController::class,
        'myvacancies'   =>  MyVacancyController::class
    ]);
});


Route::post('/cities', [CityController::class, 'getCities'])->name('cities');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
