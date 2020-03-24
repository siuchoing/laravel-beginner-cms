@extends('layouts.admin')

@section('content')
    <h1>User</h1>
    <table class="table">
        <thead class="thead-black">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Photo</th>
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
                    <td>
                        <!-- Method 1A - using Model (Recommend in thid case) -->
                        <img height="50" src="{{$user->photo_path ? $user->photos->first()->path : '' }}" alt="">

                        <!-- Method 1B - using Model (Recommend in thid case) -->
                        <!-- <img height="50" src="{{$user->photo_path ? $user->photos->all()[0]->path : '' }}" alt=""> -->
                    <!-- <img height="50" src="{{$user->photo_path ? $user->photos->get(0)->path : '' }}" alt=""> -->
                    </td>
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
