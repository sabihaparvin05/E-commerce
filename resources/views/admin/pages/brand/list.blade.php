@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Brand list</h1>
            <a href="{{route('brand.create')}}" class="btn btn-success">Create new brand</a>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)

                    <tr>
                        <th scope="row">{{ $brand->id }}</th>
                        <td>{{$brand->name}}</td>
                        <td>
                            <img width="10%" src="{{url('/uploads/'.$brand->logo)}}" alt="">
                        </td>
                        <td>{{$brand->description}}</td>
                        <td>{{$brand->status}}</td>
                        <td>
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