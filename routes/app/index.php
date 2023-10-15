<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Index');
        })->name('app.index');
    });

