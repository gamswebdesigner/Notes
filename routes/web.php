<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('home');
    Route::redirect('/home', 'home');
    Route::get('/note', [NoteController::class, 'note'])->name('note');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
