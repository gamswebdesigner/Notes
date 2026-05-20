<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class NoteController extends Controller
{
    public function index()
    {
        $user = auth()->user('id');
        $notes = User::find($user['id'])->notes()->get()->toArray();

        return view('home', ['notes' => $notes]);
    }

    public function note()
    {
        return view('note');
    }
}
