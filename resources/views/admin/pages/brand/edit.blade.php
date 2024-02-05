@extends('admin.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit brand details</h1>
            <form action="{{route('brand.update',$brands->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="">Enter brand name:</label>
                    <input value="{{$brands->name}}" required type="text" class="form-control" id="" placeholder="Enter brand name" name="name">
                </div>

                <div class="form-group">
                    <label for="">Select status</label>
                    <select name="status" class="form-control" id="">
                        <option value="active" {{ $brands->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $brands->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Enter brand logo:</label>
                    <input type="file" class="form-control" id="" placeholder="Enter brand logo" name="logo">
                </div>

                <div class="form-group">
                    <label for="">Enter brand description:</label>
                    <input value="{{$brands->description}}" required type="text" class="form-control" id="" placeholder="Enter brand description" name="description">
                </div>

                <button class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection