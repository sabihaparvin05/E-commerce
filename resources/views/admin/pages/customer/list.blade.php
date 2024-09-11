@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Customer list</h1>
     
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">serial</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $key=>$data)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>0{{$data->phone}}</td>
                        <td>{{$data->address}}</td>
                        <td>
                            <img style="border-radius: 60px;" width="15%" 
                            @if($data->image)
                            <img src="{{url('/uploads/'.$data->image)}}">
                            @else
                            <img style="height: 10px; width:min-content;" src="{{ url('/uploads/noimage.png') }}">
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="">View</a>
                            <a class="btn btn-success" href="">Edit</a>
                            <a class="btn btn-danger" href="">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection