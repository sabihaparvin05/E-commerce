@extends('admin.master')

@section('content')
<div class="container">
    <h1>Assign Permission for {{$role->name}}</h1>

    @php
    $rolePermissions=$role->permissions->pluck('permission_id')->toArray();
    @endphp

    <div class="row">
        <div class="col">

            @foreach($all_permission as $permission)
            <form action="{{route('assign.permission', $role->id)}}" method="post">
                @csrf
                <div class="form-check">
                    <input 
                    @if(in_array($permission->id, $rolePermissions))
                    checked
                    @endif
                    name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission->id}}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{$permission->name}}
                    </label>
                </div>
                @endforeach
                <button class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection