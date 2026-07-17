<?php

use App\Http\Controllers\Settings\SetLocaleController;
use Illuminate\Support\Facades\Route;

Route::put('settings/locale', SetLocaleController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('/', 'Dashboard')->name('home');
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

use DefStudio\Telegraph\Models\TelegraphChat;

Route::get('/send-telegram', function () {
    $chat = TelegraphChat::where('chat_id', '-5425573628')->first();
    $chat->message('Привет!')->send();
    return response()->json(['Сообщение успешно отправлено'], 200);
});
