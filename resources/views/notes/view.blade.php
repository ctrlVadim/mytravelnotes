<?php

use App\Models\User

?>

@extends('layouts.app')

@section('title', $note->title)

@section('content')
    <div class="container">
        <div class="block">
            <h1>{{$note->title}}</h1>
            <div class="note__stat mb-3">
                <div>
                    <img src="/images/author.svg" alt="Author" title="Author">
                    <span>
                        {{$note->user->name}}
                    </span>
                </div>
                <div class="d-flex">
                    <div class="rating-stars">
                        <span style="width: {{$rating * 20}}%;"></span>
                    </div>
                    <span>{{$rating}}</span>
                </div>
            </div>
            <div class="text">{{$note->article}}</div>
            @if (Auth::user() and $note->user_id === Auth::user()->id)
                <div class="edit_event mt-5 mb-5">
                    <a class="carmine mr-3" href="{{route('edit', $note)}}">Edit</a>
                    <a class="carmine" href="{{route('delete', $note->id)}}">Delete</a>
                </div>
            @endif
        </div>

        @if (count($comments))
            <div class="comments mt-5">
                <h2>Comments</h2>
                @if (Auth::user())
                    <input type="hidden" id="note_stat" data-note_id="{{$note->id}}" data-user_id="{{Auth::user()->id}}">
                    <button class="create_comment mb-4 btn carmine-bg text-white">Add comment</button>
                    @include('notes._comment-form')
                @endif
                @foreach($comments as $comment)
                    @include('notes._comment', compact('comment'))
                @endforeach
            </div>
        @endif
    </div>
@endsection
