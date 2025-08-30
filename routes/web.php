<?php

use App\Http\Controllers\CarWebController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/', [CarWebController::class, 'index'])->name('dashboard');

    Route::prefix('cars')->as('cars.')->group(function () {
        Route::get('/create', [CarWebController::class, 'create'])->name('create');
        Route::post('/', [CarWebController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CarWebController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CarWebController::class, 'update'])->name('update');
        Route::delete('/{id}', [CarWebController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
