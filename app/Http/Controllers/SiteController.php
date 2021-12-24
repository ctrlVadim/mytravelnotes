<?php


namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        $total_count_of_notes = count(Note::all());
        $total_count_of_comments = count(Comment::all());
        $last_note = Note::orderBy('created_at', 'asc')->first();
        $most_talked_note_id = DB::select('
                SELECT note.id
                FROM notes as note
                INNER JOIN (
                    SELECT note_id, count(*) AS note_count
                    FROM comments
                    GROUP BY note_id
                ) as comment on note.id = comment.note_id
                order by comment.note_count desc
                limit 1
            ')[0]->id;
        $most_talked_note = Note::where('id', $most_talked_note_id)->first();
        $count_of_created_notes = 0;
        $count_of_created_comments = 0;
        $my_last_note = null;
        if (Auth::user()){
            $count_of_created_notes = count(Note::
                where([
                    ['created_at', '>=', Carbon::now()->startOfMonth()->toDateString()],
                    ['user_id', Auth::user()->id]
                ])
                ->get()
            );
            $count_of_created_comments = count(Comment::
                where([
                    ['created_at', '>=', Carbon::now()->startOfMonth()->toDateString()],
                    ['user_id', Auth::user()->id]
                ])
                ->get()
            );
            $my_last_note = Note::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->first();
        }
        return view('home', compact(
            'total_count_of_comments',
            'total_count_of_notes',
            'last_note',
            'count_of_created_notes',
            'count_of_created_comments',
            'my_last_note',
            'most_talked_note'
        ));
    }
}
