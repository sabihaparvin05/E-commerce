@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Users list</h1>
            <a class="btn btn-secondary mt-0 mb-3" href="{{route('create.user')}}">Create</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">serial</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>0{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            <img style="border-radius: 60px;" width="15%" 
                            @if($user->image)
                            <img src="{{url('/uploads/'.$user->image)}}">
                            @else
                            <img style="height: 10px; width:min-content;" src="{{ url('/uploads/noimage.png') }}">
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('user.view', $user->id)}}">View</a>
                            <a class="btn btn-success" href="{{route('user.edit', $user->id)}}">Edit</a>
                            <a class="btn btn-danger" href="{{route('user.delete', $user->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection