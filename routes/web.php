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
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/new-note', [NoteController::class, 'note'])->name('newNote');
    Route::get('/{user}/note', [NoteController::class, 'note'])->name('editNote');
    Route::post('/save', [NoteController::class, 'save'])->name('save');
});
