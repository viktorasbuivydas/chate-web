<?php

use App\Http\Controllers\App\ConversationMessageController;
use Illuminate\Support\Facades\Route;


Route::controller(ConversationMessageController::class)
    ->name('app.inbox.')
    ->prefix('/app/inbox/{conversation}')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/messages', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
    });
