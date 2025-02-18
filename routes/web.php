<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelContractController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'view'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('/bills')->name('bill.')->group(function () {
        Route::get('/generate', [BillController::class, 'generateBills'])->name('generate');
        Route::prefix('/{bill}/')->group(function () {
            Route::post('/pay', [BillController::class, 'pay'])->name('pay');
            Route::get('/download', [BillController::class, 'generatePdf'])->name('download');
        });
    });

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

    Route::prefix('/contracts')->name('contract.')->group(function () {
        Route::get('/', [ContractController::class, 'index'])->name('index');
        Route::get('/create', [ContractController::class, 'create'])->name('create');
        Route::get('/create/{box}', [ContractController::class, 'create'])->middleware('ownerBox')->name('createWithBox');
        Route::post('/store', [ContractController::class, 'store'])->name('store');

        Route::prefix('/{contract}')->middleware('ownerContract')->group(function () {
            Route::get('/show', [ContractController::class, 'show'])->name('show');
            Route::get('/edit', [ContractController::class, 'edit'])->name('edit');
            Route::put('/update', [ContractController::class, 'update'])->name('update');
            Route::delete('/delete', [ContractController::class, 'destroy'])->name('destroy');
            Route::get('/download', [ContractController::class, 'generatePdf'])->name('pdf');
        });
    });
});

require __DIR__ . '/auth.php';
