@extends('admin.master')

@section('content')

<form action="{{route('role.update', $roles->id)}}" method="post">
    @csrf

    @method('put')
    
    <div class="form-group">
        <label for="">Enter Roles Name:</label>
        <input value="{{$roles->name}}" required type="text" class="form-control" id="" placeholder="Enter name" name="name">
    </div>

    <div class="form-group">
        <label for="">Enter Roles Description:</label>
        <input value="{{$roles->description}}" class="form-control" name="description" id="" cols="30" rows="10" required>
    </div>
    <div class="form-group">
        <label for="status">Status </label>
        <select name="status" id="status" class="form-control" required>
            <option value="">Select Status</option>
            <option value="active" {{ $roles->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $roles->status == 'inactive' ? 'selected' : '' }}>Inactive</option>

        </select>

    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection