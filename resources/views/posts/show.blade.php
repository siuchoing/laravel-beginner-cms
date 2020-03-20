@extends('layouts.app_card')

@section('card-header')
    <div class="d-flex justify-content-between">
        <h3> {{ $post->title }} </h3>
        <a href="{{route('posts.edit', $post->id)}}">
            <button type="submit" class="btn btn-primary">Edit</button>
        </a>
    </div>
@stop

@section('card-body')
    <h4>{{ $post->content }}</h4>
@stop

