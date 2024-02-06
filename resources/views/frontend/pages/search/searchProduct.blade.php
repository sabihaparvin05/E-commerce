@extends('frontend.master')
@section('content')

<h2>Search result for : {{ request()->search }} found {{$products->count()}} products.</h2>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    @if($products->count()>0)
    @foreach ($products as $product)

    <div class="container">
        <div class="row dd-flex justify-content-center">
            <a href="{{route('single.product',$product->id)}}">
                <div class="col-md-8">
                    <div class="card px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product_image"> <img src="{{url('/uploads/'.$product->image)}}"> </div>
                            </div>
                            <div class="col-md-6">

                                <span class="fw-bold ms-1 fs-5">{{$product->name}}</span>
                            </div>
                            <div class="fs-1 ms-1 mt-3">{{$product->description}}</div>
                            <div class="ms-1"> <span>{{$product->price}}.BDT</span> </div>

                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>

@endforeach

@else

<h1>No product found.</h1>
@endif
</div>

@endsection