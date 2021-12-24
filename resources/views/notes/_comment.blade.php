<?php

use App\Models\User

?>

<div class="brad-2 comment shadow mb-md-3 p-3 bg-white d-block text-dark text-decoration-none">
        <input type="hidden" class="comment_stat" data-comment_id="{{$comment->id}}" data-author_id="{{$comment->user_id}}">
    <div class="comment__row d-flex mb-2">
        <div class="comment__user carmine">
            <img src="/images/author.svg" alt="Author" title="Author">
            <span>
                {{$comment->user->name}}
            </span>
        </div>
        <div class="comment__date">
            <img src="/images/schedule.svg" alt="Date" title="Date">
            <span>
                {{ explode(' ', $note->created_at)[0]}}
            </span>
        </div>
        <div class="comment__rate">
            <div class="rating-stars">
                <span style="width: {{$comment->rate * 20}}%;"></span>
            </div>
        </div>
    </div>
    <div class="comment__text">
        {{$comment->text}}
    </div>
    @if (Auth::user() and Auth::user()->id === $comment->user_id)
        <div class="comment__edit" style="display: none;">
            <div class="form-group">
                <label class="form-check-label  carmine" for="text">
                    Comment
                </label>
                <textarea class="form-control text" name="text">{{$comment->text}}</textarea>
            </div>
            <div class="form-group">
                <label  class="form-check-label carmine" for="rate">
                    Rate
                </label>
                <input type="number" value="{{$comment->rate}}" step="0.1" name="rate" min="0" max="5" class="form-control w-auto rate" size="2">
            </div>
            <div class="form-group mb-0">
                <button type="submit" class="update-comment btn btn-group carmine-bg text-white">Save</button>
            </div>
        </div>
    @endif
    <div class="comment_bottom_event d-flex justify-content-between mt-3">
        <div class="comment__stat">
            <span class="mr-2">
                <span class="stat-number" data-type="1">{{$comment->getLikesCount()}}</span>
                <img src="/images/like{{$comment->isRated('1', Auth::user() ? Auth::user()->id : '')}}.svg" alt="Likes" title="Likes" class="like mr-2" data-type="1">
                <img src="/images/dislike{{$comment->isRated('0', Auth::user() ? Auth::user()->id : '')}}.svg" alt="Dislikes" title="Dislikes" class="like" data-type="0">
                <span class="stat-number" data-type="0">{{$comment->getDislikesCount()}}</span>
            </span>
        </div>
        @if (Auth::user() and Auth::user()->id === $comment->user_id)
            <div class="comment__edit">
                <div class="edit_event">
                    <a class="comment_update carmine mr-3">Edit</a>
                    <a class="comment_delete carmine">Delete</a>
                </div>
            </div>
        @endif
    </div>
</div>




