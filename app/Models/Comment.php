<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App\Models
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $article
 * @property int $note_id
 */

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'rate',
        'text',
        'note_id',
    ];

    public function getLikesCount(){
        return count(CommentRate::where([
            ['comment_id', $this->id],
            ['type', '1']
        ])->get());
    }


    public function getDislikesCount(){
        return count(CommentRate::where([
            ['comment_id', $this->id],
            ['type', '0']
        ])->get());
    }


    public function isRated($type, $user_id){
        $stat = CommentRate::where([
            ['comment_id', $this->id],
            ['user_id', $user_id],
            ['type', $type],
        ])->first();
        return isset($stat) ? '-fill' : '';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
