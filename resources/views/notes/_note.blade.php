<?php

use App\Models\User;
use App\Models\Note;

?>

<a title="View note" href="/note/{{$note->id}}" class="overflow-hidden brad-2 note shadow mb-md-3 p-3 bg-white d-block text-dark text-decoration-none">
    <div class="d-flex">
        <div class="note-stat">
            <h2 class="note__title carmine">
                {{$note->title}}
            </h2>
            <div class="note__data d-flex mb-2">
                <div class="note__author mr-5">
                    <img src="/images/author.svg" alt="Author" title="Author">
                    <span>
                {{$note->user->name}}
            </span>
                </div>
                <div class="note__date">
                    <img src="/images/schedule.svg" alt="Date" title="Date">
                    <span>
                {{ explode(' ', $note->created_at)[0]}}
            </span>
                </div>
            </div>
            <div class="note__text h4">
                {{ substr($note->article, 0, 100) . '...' }}
            </div>
            <div class="note__stat d-flex mt-4 justify-content-between">
                <div class="d-flex">
                    <div class="note__view mr-4">
                        <img src="/images/view.svg" alt="Views" title="Views">
                        <span>
                {{ $note->getViewsCount() }}
            </span>
                    </div>
                    <div class="note_comment mr-4">
                        <img src="/images/comment.svg" alt="Comments" title="Comments">
                        <span>
                {{ $note->getCommentsCount() }}
            </span>
                    </div>
                    <div class="note_rate">
                        <div class="rating-stars">
                            <span style="width: {{ $note->getRate() * 20 }}%;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="note-image"
             @if ($note->image)
                 style="background-image: url({{Storage::url($note->image)}});"
             @endif
         ></div>
    </div>
</a>
