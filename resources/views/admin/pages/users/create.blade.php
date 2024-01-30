@extends('admin.master')

@section('content')

<h1>Create new User</h1>

<form action="{{route('store.user')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="">Enter User Name:</label>
    <input required type="text" class="form-control" id="" placeholder="Enter name" name="user_name">
  </div>

  <div class="form-group">
    <label for="">Select Role:</label>
    <select required class="form-control" name="role" id="">
      <option value="manager">Manager</option>
      <option value="accountant">Accountant</option>
    </select>
  </div>


  <div class="form-group">
    <label for="">Phone Number: </label>
    <input required type="number" class="form-control" placeholder="Enter phone number" name="phone">
  </div>

  <div class="form-group">
    <label for="">Enter Email: </label>
    <input required type="email" class="form-control" placeholder="Enter Email" name="user_email">
  </div>

  <div class="form-group">
    <label for="">Address: </label>
    <input required type="text" class="form-control" placeholder="Enter address" name="address">
  </div>

  <div class="form-group">
    <label for="">Enter Password: </label>
    <input required type="password" class="form-control" placeholder="Enter password" name="user_password">
  </div>

  <div class="form-group">
    <label for="">Upload Image: </label>
    <input name="user_image" type="file" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
