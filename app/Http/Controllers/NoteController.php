<?php


namespace App\Http\Controllers;


use App\Http\Requests\NoteRequest;
use App\Models\Comment;
use App\Models\Note;
use App\UseCases\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Image;

class NoteController extends Controller
{
    private Note $note;
    private NoteService $service;


    public function __construct(Note $note, NoteService $service)
    {
        $this->note = $note;
        $this->service = $service;
    }

    public function catalog()
    {
        $notes = Note::orderBy('created_at', 'desc')->get();
        return view('notes.catalog', compact('notes'));
    }


    public function view($note_id)
    {
        if (Auth::user()){
            $this->service->incrementViewsCount(Auth::user()->id, $note_id);
        }

        $note = Note::where('id', $note_id)->first();
        $comments = Comment::where('note_id', intval($note_id))->get();
        $rating = $this->note->getRate($note_id);
        return view('notes.view', compact('note', 'comments', 'rating'));
    }


    public function create()
    {
        return view('notes.create');
    }


    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }


    public function store(NoteRequest $form)
    {
        $user_id = Auth::user()->id;

        try {
            $note = $this->service->create(
                $user_id,
                $form
            );
        }catch (\DomainException $e){
            \Session::flash('danger', $e->getMessage());
            return back();
        }
        \Session::flash('success', 'Note successfully created');
        return redirect()->route('note');
    }


    public function update(Note $note, NoteRequest $form)
    {
        try {
            $this->service->edit(
                $note,
                $form
            );
        }catch (\DomainException $e){
            \Session::flash('danger', $e->getMessage());
            return back();
        }
        \Session::flash('success', 'Note successfully updated');
        return redirect()->route('view',  $note->id);
    }


    public function delete(Note $note)
    {
        try {
            $this->service->delete($note);
        }catch (\DomainException $e){
            \Session::flash('danger', $e->getMessage());
            return back();
        }
        \Session::flash('success', 'Note successfully deleted');
        return redirect()->route('note');
    }
}
