@extends('layouts.app_card')

@section('card-header')
    <h2>Post</h2>
@stop

@section('card-body')
    <ul>
        @foreach($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
@endsection
