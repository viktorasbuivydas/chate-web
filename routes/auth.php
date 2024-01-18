<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('/auth/google')
    ->name('auth.google.')
    ->group(function () {
        Route::get('/redirect', [AuthController::class, 'redirect'])->name('redirect');
        Route::get('/callback', [AuthController::class, 'callback'])->name('callback');
        Route::post('/request', [AuthController::class, 'request'])->name('request');
    });
