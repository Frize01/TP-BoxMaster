<?php

use App\Http\Controllers\BoxController;
use App\Http\Controllers\ProfileController;
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

    Route::prefix('/box')->name('box.')->group(function () {
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
});

require __DIR__.'/auth.php';
