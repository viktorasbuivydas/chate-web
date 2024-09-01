<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app/settings')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Settings/Index');
        })->name('app.settings.index');
    });
