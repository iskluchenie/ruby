<?php

use App\Http\Controllers\Settings\SetLocaleController;
use Illuminate\Support\Facades\Route;

Route::put('settings/locale', SetLocaleController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('/', 'Dashboard')->name('home');
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
