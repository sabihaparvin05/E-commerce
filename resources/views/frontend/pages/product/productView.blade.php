@extends('frontend.master')


@section('content')


<div class="container">
    <div class="row dd-flex justify-content-center">
        <div class="col-md-8">
            <div class="card px-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-row align-items-center"> <i class='fa fa-apple fs-1'></i>
                        <h1 class="fs-1 ms-1 mt-3">{{$singleProduct->name}}</h1></div>
                        <div><span class="fw-bold ms-1 fs-5">{{$singleProduct->brand->name}}</span> </div>
                        <div class="ms-1"> <span>{{$singleProduct->description}}</span> </div>
                        <div class="ms-1"> <span>{{$singleProduct->price}} BDT</span> </div>
                        
                        <a href="{{route('add.to.Cart',$singleProduct->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                    <div class="col-md-6">
                        <div class="product-image"> <img src="{{url('/uploads/'.$singleProduct->image)}}"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection