@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Role list</h1>
            <a class="btn btn-success mt-0 mb-3" href="{{route('role.create')}}">Create Role</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">serial</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key=>$role)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                        <td>{{$role->status}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('role.assign', $role->id)}}">Role Assign</a>
                            <a class="btn btn-primary" href="#">View</a>
                            <a class="btn btn-success" href="{{route('role.edit', $role->id)}}">Edit</a>
                            <a class="btn btn-danger" href="{{route('role.delete', $role->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection