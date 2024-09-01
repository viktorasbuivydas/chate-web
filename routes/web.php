<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return Inertia::render('Index');
})->name('index');

// app routes
Route::group([], base_path('routes/app/index.php'));
Route::group([], base_path('routes/app/chat.php'));
Route::group([], base_path('routes/app/inbox.php'));
Route::group([], base_path('routes/app/notification.php'));
Route::group([], base_path('routes/app/forum.php'));

Route::group([], base_path('routes/app/statistic.php'));
Route::group([], base_path('routes/app/settings.php'));

// admin routes
Route::group([], base_path('routes/app/admin.php'));

// auth routes
Route::group([], base_path('routes/auth.php'));
