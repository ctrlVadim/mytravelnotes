<?php


namespace App\UseCases;


use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentRate;

class CommentService
{
    public function create(CommentRequest $form){
        $comment = Comment::create([
            'note_id' => $form['note_id'],
            'user_id' => $form['user_id'],
            'text' => $form['text'],
            'rate' => $form['rate']
        ]);
        return $comment;
    }


    public function update(Comment $comment, CommentRequest $form){
        $comment->update([
            'text' => $form['text'],
            'rate' => $form['rate'],
        ]);
        return $comment;
    }


    public function delete(Comment $comment){
        return $comment->delete();
    }
}
