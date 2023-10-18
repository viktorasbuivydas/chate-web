<?php

use App\Http\Controllers\App\ChatController;
use Illuminate\Support\Facades\Route;


Route::controller(ChatController::class)
    ->name('app.chat.')
    ->prefix('/app/chat')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });
