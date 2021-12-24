<?php


namespace App\Http\Controllers;


use App\Models\Note;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $search = $request->input('search');
        $notes = Note::
            where('title', 'LIKE', "%{$search}%")
            ->orWhere('article', 'LIKE', "%{$search}%")
            ->get();
        return view('search.search', compact('notes'));
    }
}
