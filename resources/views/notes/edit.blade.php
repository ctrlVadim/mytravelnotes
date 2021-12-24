@extends('layouts.app')
@section('title', 'Edit note')
@section('content')
    <div class="container">
        <h1>Create note</h1>
        <form method="POST" action="{{ route('update', $note) }}">
            @method('PUT')
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="form-group">
                <label class="form-check-label  carmine" for="title">
                    Title
                </label>
                <input class="form-control" type="text" id="title" value="{{$note->title}}" name="title">
            </div>
            <div class="form-group">
                <label class="form-check-label carmine" for="article">
                    Article
                </label>
                <textarea class="form-control" name="article" id="article" cols="30" rows="10">{{$note->article}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-group carmine-bg text-white">Update</button>
            </div>
        </form>
    </div>
@endsection
