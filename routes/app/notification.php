<?php

use Illuminate\Support\Facades\Route;

Route::prefix('app/notifications')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            return inertia('App/Notification/Index');
        })->name('app.notifications.index');
    });
