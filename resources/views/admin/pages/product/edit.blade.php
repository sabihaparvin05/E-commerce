@extends('admin.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Edit product details</h1>
            <form action="{{route('product.update',$products->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="">Enter product name:</label>
                    <input value="{{$products->name}}" required type="text" class="form-control" id="" placeholder="Enter brand name" name="product_name">
                </div>

                <div class="form-group">
                    <label for="">Select Brand:</label>
                    <select required class="form-control" name="brand_id" id="">

                        @foreach ($brands as $brand)
                        <option @if($products->brand_id==$brand->id)
                            selected
                            @endif value="{{$brand->id}}">{{$brand->name}}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="">Select Category:</label>
                    <select required class="form-control" name="category_id" id="">

                        @foreach ($categories as $category )
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="">Enter product image:</label>
                    <input type="file" class="form-control" id="" placeholder="Enter product image" name="image">
                </div>

                <div class="form-group">
                    <label for="">Enter product price:</label>
                    <input value="{{$products->price}}" type="ineteger" class="form-control" id="" placeholder="Enter product price" name="price">
                </div>

                <div class="form-group">
                    <label for="">Enter product stock:</label>
                    <input value="{{$products->stock}}" type="integer" class="form-control" id="" placeholder="Enter product stock" name="stock">
                </div>

                <div class="form-group">
                    <label for="">Enter product description:</label>
                    <input value="{{$products->description}}" type="text" class="form-control" id="" placeholder="Enter product description" name="description">
                </div>

                <div class="form-group">
                    <label for="">Select status</label>
                    <select name="status" class="form-control" id="">
                        <option value="active" {{ $products->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $products->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection