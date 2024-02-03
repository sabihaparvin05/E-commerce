@extends('admin.master')

@section('content')

<div class="container">
    <div class="col">
        <h1 class="text-center">View User Details</h1>

        <div class="container">
            <div class="row dd-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mt-3">Name: {{$users->name}}</h4>
                                </div>
                                <h4>Role: {{$users->role->name}}</h4>
                                <h4>Phone: {{$users->phone}}</h4>
                                <h4>Email: {{$users->email}}</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="product-image">
                                    @if($users->image)
                                    <img src="{{url('/uploads/'.$users->image)}}">
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