@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Product list</h1>
            <a class="btn btn-success mt-0 mb-3" href="{{route('product.create')}}">Create New Category</a>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Brand</th>
                        <th scope="col">Product Category</th>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Stock</th>
                        <th scope="col">Product Status</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key=>$product)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>
                            <img width="20%" src="{{url('/uploads/'.$product->image)}}" alt="">
                        </td>
                        <td>{{$product->price}} .BDT</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->status}}</td>
                        <td>
                            <a class="btn btn-success" href="">View</a>
                            <a class="btn btn-danger" href="">Delete</a>
                            <a class="btn btn-primary" href="">Edit</a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection