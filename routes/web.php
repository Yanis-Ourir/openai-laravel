<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/chat', [\App\Http\Controllers\ChatController::class, 'chat'])->name('chatPrompt');
