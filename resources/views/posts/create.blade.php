@extends('layouts.app_card')

@section('card-header')
    <h2>Create Post</h2>
@stop

@section('card-body')
    <div class="container">
        <form method="post" action="/posts">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter title">
            </div>
            @if($errors->has('title'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{$errors->first('title')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" name="content" placeholder="Enter content">
            </div>
            @if($errors->has('content'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{$errors->first('content')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
        </form>
    </div>
@stop

