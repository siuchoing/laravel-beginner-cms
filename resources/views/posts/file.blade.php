@extends('layouts.app_card')

@section('card-header')
    <h2>Retrieving file data</h2>
@stop

@section('card-body')
    <div class="container">
        <form method="post" action="/post/file/create/1" accept-charset="UTF-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="file" type="file" class="form-control-file" id="photo">
            </div>
            <button type="submit" class="btn btn-primary" style="float: right">Get file data</button>
        </form>
    </div>
@stop

