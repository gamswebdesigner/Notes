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
    Route::redirect('/home', '/');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::view('/note/new', [NoteController::class, 'note'])->name('newNote');
    Route::get('/note/edit/{id}', [NoteController::class, 'edit'])->name('editNote');
    Route::get('/note/{id}', [NoteController::class, 'delete'])->name('deleteNote');
    Route::post('/save', [NoteController::class, 'save'])->name('save');
});
