<?php


namespace App\UseCases;


use App\Models\CommentRate;

class CommentRateService
{
    public function update($stat){
        return $stat->update([
            'type' => $stat->type ? '0' : '1',
        ]);
    }


    public function delete($stat){
        return $stat->delete();
    }


    public function create($type, $user_id, $comment_id){
        return CommentRate::create([
            'type' => $type,
            'user_id' => $user_id,
            'comment_id' => $comment_id,
        ]);
    }
}
