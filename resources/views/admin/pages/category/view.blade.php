@extends('admin.master')

@section('content')

<div class="container">
    <div class="col">
        <h1 class="text-center">View Category Details</h1>

        <div class="container">
            <div class="row dd-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-row align-items-center">
                                    <h4 class="mt-3">Name: {{$category->name}}</h4>
                                </div>
                                <h4>Description: {{$category->description}}</h4>
                                <h4>Status: {{$category->status}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection