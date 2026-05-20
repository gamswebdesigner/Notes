<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

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

    public function save(Request $request, $id = null)
    {
        $request->validate([
            'note_title' => 'required|min:3|max:200',
            'note_text' => 'required|min:3|max:3000'
        ]);

        try {
            $realId = $id ? Operations::decrypt($id) : null;
            Note::updateOrCreate(
                ['id' => $realId],
                [
                    'user_id' => auth()->id(),
                    'title' => $request->input('note_title'),
                    'text' => $request->input('note_text')
                ]
            );

            return redirect()->route('home')->with('success', 'Note saved!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Fail to save, intern server error!');
        }
    }

    public function edit($id)
    {
        return view('note', ['note_id' => $id]);
    }

    public function delete($id)
    {
        return 'delete';
    }
}
