<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app/admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Admin');
        })->name('app.admin.index');
    });
