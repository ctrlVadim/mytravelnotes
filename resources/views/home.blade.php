<?php

use App\Models\User;
use App\Models\Note;

?>


@extends('layouts.app')
@section('title', 'MyTravelNotes')
@section('content')
<div class="container">
    <h1>Site statistic</h1>
    <div class="mb-5">
        <h2>
            Total number of notes:
            <span class="carmine">{{$total_count_of_notes}}</span>
        </h2>
    </div>
    <div class="mb-5">
        <h2>
            Total number of comments:
            <span class="carmine">{{$total_count_of_comments}}</span>
        </h2>
    </div>
    @if (Auth::user())
        <div class="mb-5">
            <h2>
                For the last month I have created notes:
                <span class="carmine">{{$count_of_created_notes}}</span>
            </h2>
        </div>
        <div class="mb-5">
            <h2>
                I have left comments in the last month:
                <span class="carmine">{{$count_of_created_comments}}</span>
            </h2>
        </div>
        <div class="mb-5">
            @if ($my_last_note)
                <h2>My last note:</h2>
                @php
                    $note = $my_last_note;
                @endphp
                @include('notes._note', compact('note'))
            @endif
        </div>
    @endif
    <div class="mb-5">
        <h2>Most talked about note:</h2>
        @php $note = $most_talked_note; @endphp
        @include('notes._note', compact('note'))
    </div>
</div>
@endsection
