<?php


namespace App\UseCases;


use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\NoteViews;
use App\Models\User;

class NoteService
{
    public function create($user_id, NoteRequest $form): Note
    {
        $note = Note::create([
            'title' => $form['title'],
            'article' => $form['article'],
            'user_id' => $user_id,
            'views' => 0,
        ]);

        if ($file = $form->file('image')){
            $file->storeAs('public/notes/' . $note->id, $file->getClientOriginalName());
            $note->update([
                'image' => 'notes/' . $note->id . '/' . $file->getClientOriginalName(),
            ]);
        }

        return $note;
    }


    public function edit(Note $note, NoteRequest $form){
        return $note->update([
            'title' => $form['title'],
            'article' => $form['article'],
        ]);
    }


    public function delete(Note $note){
        return $note->delete();
    }

    public function incrementViewsCount($user_id, $note_id){
        $exists = NoteViews::where([
            ['user_id', $user_id],
            ['note_id', $note_id],
        ])->first();

        if (!$exists)
            return NoteViews::create([
                'user_id' => $user_id,
                'note_id' => $note_id,
            ]);
    }
}
