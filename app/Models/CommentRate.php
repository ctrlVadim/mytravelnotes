<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CommentRate extends Model
{
    protected $table = 'comment_rate';

    protected $fillable = [
        'user_id',
        'comment_id',
        'type',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
