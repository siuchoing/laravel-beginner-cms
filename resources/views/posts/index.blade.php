@extends('layouts.app_card')

@section('card-header')
    <div class="d-flex justify-content-between">
        <h2>Post</h2>
        <a href="{{route('posts.create')}}">
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </a>
    </div>
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
