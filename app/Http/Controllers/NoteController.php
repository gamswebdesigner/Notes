<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(User $user)
    {
        $notes = $user->notes;
        return view('home', compact('user', 'notes'));
    }

    public function note()
    {
        echo 'note';
    }
}
