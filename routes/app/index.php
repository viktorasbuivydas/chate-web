<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app')
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Index');
        })->name('app.index');
    });

