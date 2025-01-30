<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryEntityController;
use App\Http\Controllers\Admin\EntityController;
use App\Http\Controllers\Admin\ImportChurchController;
use App\Http\Controllers\Admin\ImportEntityController;
use App\Http\Controllers\Admin\ImportLawyerController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkController;

Route::name('admin.')->prefix('admin')->group(function () {

    Route::middleware(['verified', 'role:super-admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('user', UserController::class)->except([
            'show'
        ]);
        Route::resource('category', CategoryController::class)->except([
            'show'
        ]);
        Route::resource('type', TypeController::class)->except([
            'show'
        ]);
        Route::resource('entity', EntityController::class)->except([
            'show'
        ]);
        Route::resource('offer', OfferController::class)->except([
            'show'
        ]);
        Route::resource('work', WorkController::class)->except([
            'show'
        ]);

        Route::get('entity/report', [EntityController::class, 'report'])->name('entity.report');

        Route::get('category-entity', [CategoryEntityController::class, 'index'])->name('category-entity.index');

        Route::get('/import-church', [ImportChurchController::class, 'index'])->name('import.church');
        Route::post('/import-church', [ImportChurchController::class, 'import']);

        Route::get('/import-entity', [ImportEntityController::class, 'index'])->name('import.entity');
        Route::post('/import-entity', [ImportEntityController::class, 'import']);

        Route::get('/import-lawyer', [ImportLawyerController::class, 'index'])->name('import.lawyer');
        Route::post('/import-lawyer', [ImportLawyerController::class, 'import']);
    });

    require __DIR__ . '/admin-api.php';
});
