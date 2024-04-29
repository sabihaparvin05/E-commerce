@extends('frontend.master')

@section('content')


<form action="{{route('profile.update',$users->id)}}"method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                <input type="file" value="{{$users->user_image}}" class="form-control" alt="Upload Image" class="rounded-circle" width="120" name="image">
                                    <div class="middle">

                                    </div>
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">User:- {{auth('customerGuard')->user()->name}}</a></h2>
                                    <h6 class="d-block"><a href="javascript:void(0)">20</a> Completed Orders</h6>
                                    <h6 class="d-block"><a href="javascript:void(0)">6</a> Pending Oders</h6>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Full Name</label>
                            </div>
                            <div class="col-md-8 col-6">
                                <input type="text" value="{{$users->name}}" placeholder="Enter name" name="name">
                            </div>
                        </div>
                        <hr />



                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Email</label>
                            </div>
                            <div class="col-md-8 col-6">
                                <input type="text" value="{{$users->email}}" placeholder="Enter email" name="email">
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-sm-3 col-md-2 col-5">
                                <label style="font-weight:bold;">Phone Number</label>
                            </div>
                            <div class="col-md-8 col-6">
                                <input type="text" value="{{$users->phone}}" placeholder="Enter contactInfo" name="phone">
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Address </label>
                        </div>
                        <div class="col-md-8 col-6">
                        <input type="text" value="{{$users->address}}" placeholder="Enter address" name="address">
                        </div>
                    </div>
                    <hr />

                    
                        <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                            Facebook, Google, Twitter Account that are connected to this account
                        </div>
                        <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-info ">Save</button>
                                </div>
                    </div>

                </div>


            </div>

        </div>
    </div>
</form>

@endsection