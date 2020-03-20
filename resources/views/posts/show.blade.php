@extends('layouts.app_card')

@section('card-header')
    <h1>{{ $post->title }}</h1>
@stop

@section('card-body')
    <h4>{{ $post->content }}</h4>
@stop

