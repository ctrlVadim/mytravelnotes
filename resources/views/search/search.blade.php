@extends('layouts.app')

@section('title', 'Search')

@section('content')

    <div class="container">
        <h1>Search results</h1>

        @if (count($notes))
            <p>Total: {{count($notes)}}</p>
            @foreach($notes as $note)
                @include('notes._note', compact('note'))
            @endforeach
        @else
            <h2>No results were found for this request.</h2>
        @endif
    </div>
@endsection
