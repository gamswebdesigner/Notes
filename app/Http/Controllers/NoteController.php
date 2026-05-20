<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;

class NoteController extends Controller
{
    public function index()
    {
        $user = auth()->id();
        $notes = User::find($user)->notes()->get()->toArray();

        return view('home', ['notes' => $notes]);
    }

    public function edit($id)
    {
        $id = User::encrypt($id);
        return view('note', ['note_id' => $id]);
    }

    public function decryptId($id)
    {
        try {
            $id = User::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $id;
    }
}
