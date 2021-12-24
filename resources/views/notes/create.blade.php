@extends('layouts.app')
@section('title', 'Create note')
@section('content')
<div class="container">
    <h1>Create note</h1>
    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label class="form-check-label  carmine" for="title">
                Title
            </label>
            <input class="form-control" type="text" id="title" name="title">
        </div>
        <div class="form-group">
            <label class="form-check-label carmine" for="article">
                Article
            </label>
            <textarea class="form-control" name="article" id="article" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label class="form-check-label carmine" for="image">
                <span class="d-block">Image</span>
                <div class="image-file bg-white brad overflow-hidden">
                    <img src="" class="d-none" alt="">
                </div>
            </label>
            <input type="file" accept="image/*" name="image" id="image" class="d-none" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-group carmine-bg text-white">Create</button>
        </div>
    </form>
</div>


@endsection
