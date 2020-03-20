@extends('layouts.app_card')

@section('card-header')
    <h2>Post</h2>
@stop

@section('card-body')
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
