@extends('admin.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit category details</h1>
            <form action="{{route('category.update',$category->id)}}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="">Enter category name:</label>
                    <input value="{{$category->name}}" required type="text" class="form-control" id="" placeholder="Enter name" name="name">
                </div>

                <div class="form-group">
                    <label for="">Enter category description:</label>
                    <input value="{{$category->description}}" required type="text" class="form-control" id="" placeholder="Enter description" name="description">
                </div>

                <div class="form-group">
                    <label for="">Enter category status:</label>
                    <select name="status" id="" class="form-control">
                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection