<?php

use App\Actions\UpdateOnline;
use Illuminate\Support\Facades\Route;

Route::prefix('app')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function () {
            app(UpdateOnline::class)->handle('Pagrindiniame');
            return inertia('App/Index');
        })->name('app.index');
    });
