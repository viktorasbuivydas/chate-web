<?php

use App\Http\Controllers\App\ForumController;
use Illuminate\Support\Facades\Route;


Route::controller(ForumController::class)
    ->name('app.forum.')
    ->prefix('/app/forum')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
