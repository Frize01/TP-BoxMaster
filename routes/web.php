<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\ModelContractController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/boxs')->name('box.')->group(function () {
        Route::get('/', [BoxController::class, 'index'])->name('index');
        Route::get('/create', [BoxController::class, 'create'])->name('create');
        Route::post('/store', [BoxController::class, 'store'])->name('store');

        Route::prefix('/{box}')->middleware('ownerBox')->group(function () {
            Route::get('/show', [BoxController::class, 'show'])->name('show');
            Route::get('/edit', [BoxController::class, 'edit'])->name('edit');
            Route::put('/update', [BoxController::class, 'update'])->name('update');
            Route::delete('/delete', [BoxController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('/tenants')->name('tenant.')->group(function () {
        Route::get('/', [TenantController::class, 'index'])->name('index');
        Route::get('/create', [TenantController::class, 'create'])->name('create');
        Route::post('/store', [TenantController::class, 'store'])->name('store');

        Route::prefix('/{tenant}')->middleware('ownerTenant')->group(function () {
            Route::get('/show', [TenantController::class, 'show'])->name('show');
            Route::get('/edit', [TenantController::class, 'edit'])->name('edit');
            Route::put('/update', [TenantController::class, 'update'])->name('update');
            Route::delete('/delete', [TenantController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('/models')->name('modelContract.')->group(function () {
        Route::get('/', [ModelContractController::class, 'index'])->name('index');
        Route::get('/create', [ModelContractController::class, 'create'])->name('create');
        Route::post('/store', [ModelContractController::class, 'store'])->name('store');

        Route::prefix('/{modelContract}')->middleware('ownerModel')->group(function () {
            Route::get('/show', [ModelContractController::class, 'show'])->name('show');
            Route::get('/edit', [ModelContractController::class, 'edit'])->name('edit');
            Route::put('/update', [ModelContractController::class, 'update'])->name('update');
            Route::delete('/delete', [ModelContractController::class, 'destroy'])->name('destroy');
        });
    });
});

require __DIR__.'/auth.php';
