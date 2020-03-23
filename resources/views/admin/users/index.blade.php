@extends('layouts.admin')

@section('content')
    <h1>User</h1>
    <table class="table">
        <thead class="thead-black">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{!empty($user->role->name) ? $user->role->name : '--' }}</td>
                    <td>{{$user->is_active == 1 ? 'Active' : 'No Active'}}</td>
                    <td>{{$user->created_at ? $user->created_at->diffForHumans() : '--'}}</td>
                    <td>{{$user->updated_at ? $user->updated_at->diffForHumans() : '--' }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
