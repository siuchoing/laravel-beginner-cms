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
            <div></div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" name="content" placeholder="Enter content">
            </div>
            <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
        </form>
    </div>
@stop

@yield('footer')
