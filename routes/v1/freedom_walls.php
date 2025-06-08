<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreedomWallController;

Route::prefix('freedom-walls')->name('freedom-walls.')->group(function () {
    Route::post('/', [FreedomWallController::class, 'store'])->name('store');
    Route::get('/', [FreedomWallController::class, 'index'])->name('index');
    Route::get('/{id}', [FreedomWallController::class, 'show'])->name('show');
});

