<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class NoteViews extends Model
{
    protected $table = 'note_views';

    protected $fillable = [
        'user_id',
        'note_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
