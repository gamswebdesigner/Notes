<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect(route('home', auth()->user()));
    });
    Route::get('/home', function () {
        return redirect(route('home', auth()->user()));
    });
    Route::get('/note', [NoteController::class, 'note'])->name('note');
    Route::get('/{user}', [NoteController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
