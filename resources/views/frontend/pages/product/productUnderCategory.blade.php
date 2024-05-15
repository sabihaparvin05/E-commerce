@extends('frontend.master')

@section('content')

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

@if($productsUnderCategory->count()>0)
    @foreach ($productsUnderCategory as $product)

                   <div class="container">
    <div class="row dd-flex justify-content-center">
        <div class="col-md-8">
            <div class="card px-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-row align-items-center"> <i class='fa fa-apple fs-1'></i>
                        <h1 class="fs-1 ms-1 mt-3">{{$product->name}}</h1></div>
                        <div><span class="fw-bold ms-1 fs-5">{{$product->brand->name}}</span> </div>
                        <div class="ms-1"> <span>{{$product->description}}</span> </div>
                        <div class="ms-1"> <span>{{$product->price}} BDT</span> </div>
                        
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                    <div class="col-md-6">
                        <div class="product-image"> <img src="{{url('/uploads/'.$product->image)}}"> </div>
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