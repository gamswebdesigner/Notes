<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Operations;

class NoteController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $notesArray = User::find($user)->notes()->get();

        $notes = $notesArray->map(function ($note) {
            $array = $note->toArray();
            $array['hash_id'] = Operations::encrypt($note->id);
            return $array;
        })->toArray();

        return view('home', ['notes' => $notes]);
    }

    public function edit($id)
    {
        $id = Operations::encrypt($id);
        return view('note', ['note_id' => $id]);
    }
}
