<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app.inbox')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Inbox');
        })->name('app.inbox.index');
    });
