@extends('layouts.app_card')

@section('card-header')
    <div class="d-flex justify-content-between col">
        <h3> Edit Post </h3>
        <form method="post" action="/posts/{{ $post->id }}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-primary" value="DELETE">Delete</button>
        </form>
    </div>
@stop

@section('card-body')
    <div class="container">
        <form method="post" action="/posts/{{ $post->id }}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter title" value="{{ $post->title }}">
            </div>
            <div></div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" name="content" placeholder="Enter content" value="{{ $post->content }}">
            </div>
            <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
        </form>
    </div>

@stop

