<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app/statistics')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Statistic/Index');
        })->name('app.statistics.index');
    });
