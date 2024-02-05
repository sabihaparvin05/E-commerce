@extends('admin.master')

@section('content')

<div class="container">
    <div class="col">
        <h1 class="text-center">View Product Details</h1>

        <div class="container">
            <div class="row dd-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mt-3">Name: {{$products->name}}</h4>
                                </div>
                                <h4>Brand Name: {{$products->brand->name}}</h4>
                                <h4>Category: {{$products->category->name}}</h4>
                                <h4>Stock: {{$products->stock}}</h4>
                                <h4>Price: {{$products->price}}</h4>
                                <h4>Status: {{$products->status}}</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="product-image">
                                    @if($products->image)
                                    <img src="{{url('/uploads/'.$products->image)}}">
                                    @else()
                                    <img style="height: 200px; width:min-content;" src="{{ url('/uploads/noimage.png') }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection