@extends('frontend.master')
@section('content')

<form action="{{route('reset.link')}}" method="post">

  @csrf

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
  </div>

  <button type="submit" class="btn btn-primary">Send</button>
</form>

@endsection