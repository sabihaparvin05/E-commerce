@extends('frontend.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="card-title mb-4">
                        <div class="d-flex justify-content-start">
                            <div class="image-container">
                                <img src="{{url('/uploads/'. auth('customerGuard')->user()->image)}}" alt="Upload Image" class="rounded-circle" width="150">
                                <div class="middle">
                                    <a class="btn btn-success" href="{{route('profile.edit',auth('customerGuard')->user()->id)}}">Edit</a>
                                </div>
                            </div>
                            <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">User: {{auth('customerGuard')->user()->name}}</a></h2>
                              <!--  <h6 class="d-block"><a href="javascript:void(0)"></a> Approved Bookings</h6>
                                <h6 class="d-block"><a href="javascript:void(0)"></a> Pending Bookings</h6>-->
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Full Name</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{ auth('customerGuard')->user()->name }}
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Email</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{ auth('customerGuard')->user()->email }}
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Phone Number</label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{ auth('customerGuard')->user()->phone }}
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-5">
                            <label style="font-weight:bold;">Address </label>
                        </div>
                        <div class="col-md-8 col-6">
                            {{ auth('customerGuard')->user()->address }}
                        </div>
                    </div>
                    <hr />

                   
                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                        Facebook, Google, Twitter Account that are connected to this account
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>
</div>
@endsection