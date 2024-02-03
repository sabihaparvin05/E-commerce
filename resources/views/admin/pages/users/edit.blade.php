@extends('admin.master')

@section('content')


<h1>Edit Information</h1>


<form action="{{route('user.update', $users->id)}}" method="post" enctype="multipart/form-data">

    @csrf

    @method('put')

    <div class="form-group">
        <label for="">Edit User Name:</label>
        <input value="{{$users->name}}" type="text" class="form-control" id="" placeholder="Enter name" name="user_name" required>
    </div>

    <div class="form-group">
        <label for="">Edit Email: </label>
        <input value="{{$users->email}}" type="email" class="form-control" placeholder="Enter Email" name="user_email" required>
    </div>

    <div class="form-group">
        <label for="">Edit Phone: </label>
        <input value="0{{$users->phone}}" type="number" class="form-control" placeholder="Enter phone number" name="phone" required>
    </div>

    <div class="form-group">
        <label for="">Edit Address: </label>
        <input value="{{$users->address}}" type="text" class="form-control" placeholder="Enter address" name="address" required>
    </div>

    <div class="form-group">
        <label for="">Upload Image: </label>
        <input name="user_image" type="file" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection