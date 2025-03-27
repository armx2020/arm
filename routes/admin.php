<?php

use App\Http\Controllers\Admin\AppealController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryEntityController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ImportCategoryController;
use App\Http\Controllers\Admin\ImportChurchController;
use App\Http\Controllers\Admin\ImportDoctorController;
use App\Http\Controllers\Admin\ImportEntityController;
use App\Http\Controllers\Admin\ImportLawyerController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;

Route::name('admin.')->prefix('admin')->group(function () {

    Route::middleware(['role:super-admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('user', UserController::class)->except([
            'show'
        ]);

        Route::put('user/update-password/{user}', [UserController::class, 'updateUserPassword'])->name('user.update-password');
        Route::resource('category', CategoryController::class)->except([
            'show'
        ]);
        Route::resource('type', TypeController::class)->except([
            'show'
        ]);
        Route::resource('entity', EntityController::class)->except([
            'show'
        ]);

        Route::resource('image', ImageController::class)->except([
             'show', 'create', 'store', 'update'
        ]);

        Route::resource('offer', OfferController::class)->except([
            'show'
        ]);

        Route::resource('appeal', AppealController::class)->except([
            'show', 'create', 'store'
        ]);

        Route::get('entity/report', [EntityController::class, 'report'])->name('entity.report');
        Route::get('entity/report-two', [EntityController::class, 'reportTwo'])->name('entity.report-two');
        Route::get('entity/report-double', [EntityController::class, 'reportDouble'])->name('entity.report-double');

        Route::get('category-entity', [CategoryEntityController::class, 'index'])->name('category-entity.index');

        Route::get('/import-church', [ImportChurchController::class, 'index'])->name('import.church');
        Route::post('/import-church', [ImportChurchController::class, 'import']);

        Route::get('/import-entity', [ImportEntityController::class, 'index'])->name('import.entity');
        Route::post('/import-entity', [ImportEntityController::class, 'import']);

        Route::get('/import-lawyer', [ImportLawyerController::class, 'index'])->name('import.lawyer');
        Route::post('/import-lawyer', [ImportLawyerController::class, 'import']);

        Route::get('/import-doctor', [ImportDoctorController::class, 'index'])->name('import.doctor');
        Route::post('/import-doctor', [ImportDoctorController::class, 'import']);

        Route::get('/import-category', [ImportCategoryController::class, 'index'])->name('import.category');
        Route::post('/import-category', [ImportCategoryController::class, 'import']);
    });

    require __DIR__ . '/admin-api.php';
});
