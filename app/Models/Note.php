<?php

namespace App\Models;

use App\Models\Bank\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Not;

/**
 * Class Note
 * @package App\Models
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int $author_id
 * @property int $comment
 * @property string $image
 */

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'article',
        'user_id',
        'image'
    ];


    public function getRate($id = null)
    {

        $comments = Comment::
            where('note_id', $id ? intval($id) : $this->id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->get();
        $rating = 0;
        foreach ($comments as $comment) $rating += $comment->rate;
        $rating = count($comments) ? $rating / count($comments) : 0;
        return number_format($rating, 2);
    }


    public function getCommentsCount()
    {
        return count(Comment::where('note_id', $this->id)->get());
    }


    public function getViewsCount()
    {
        return count(NoteViews::where('note_id', $this->id)->get());
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

