<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\ChatController;


Route::controller(ChatController::class)
    ->name('app.chat.')
    ->prefix('/app/chat')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send-message', 'sendMessage')->name('send-message');
    });
