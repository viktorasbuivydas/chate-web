<?php

use App\Http\Controllers\App\ConversationController;
use App\Http\Controllers\App\ConversationMessageController;
use Illuminate\Support\Facades\Route;

Route::controller(ConversationController::class)
    ->name('app.conversations.')
    ->prefix('/app/conversations')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/{conversation:uuid?}', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });


Route::controller(ConversationMessageController::class)
    ->name('app.conversations.messages.')
    ->prefix('/app/conversations/{conversation:uuid}/messages')
    ->middleware(['auth'])
    ->group(function () {
        Route::post('/store', 'store')->name('store');
    });
