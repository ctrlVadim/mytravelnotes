

@extends('layouts.app')

@section('title', 'Notes')

@section('content')

    <div class="container">
        <h1>Notes</h1>
        @foreach($notes as $note)

            @include('notes._note', compact('note'))

        @endforeach
    </div>
@endsection
