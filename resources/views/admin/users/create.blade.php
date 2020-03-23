@extends('layouts.admin')
@section('content')
    <h1>Create User</h1>

    <form method="post" action="/admin/users" accept-charset="UTF-8" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" placeholder="Enter name" name="name" type="text" id="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" placeholder="Enter email" name="email" type="text" id="email">
        </div>

        <div class="form-group">
            <label for="role_id">Role:</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="" selected="selected">Choose Options</option>
                @foreach($roles as $id => $name)
                    <option value="$id">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Active</option>
                <option value="0" selected="selected">No Active</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">Photo</label>
            <input name="file" type="file" class="form-control-file" id="file">
        </div>

        <div class="form-group">
            <label for="country_id">Countries:</label>
            <select class="form-control" id="country_id" name="country_id">
                <option value="" selected="selected">Choose Options</option>
                @foreach($countries as $id => $name)
                    <option value="$id">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input class="form-control" placeholder="Enter password" name="password" type="password" value="" id="password">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Create User">
        </div>
    </form>
    @include('includes.form_error')
@stop
