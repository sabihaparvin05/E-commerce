@extends('admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Order list</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>

                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Customer Address</th>
                        <th scope="col">Receiver Name</th>
                        <th scope="col">Receiver Phone</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Transanction ID</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $data)
                    <tr>
                        <th scope="row">{{$key+1}}</th>

                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->receiver_name}}</td>
                        <td>{{$data->receiver_phone}}</td>
                        <td>{{$data->total_price}}</td>
                        <td>{{$data->transaction_id}}</td>
                        <td>{{$data->payment_method}}</td>
                        <td>
                            @if($data->payment_status == 'success')
                            paid
                            @else
                            {{$data->payment_status}}
                            @endif

                        </td>
                        <td>{{$data->created_at}}</td>
                        <td>
                            <a class="btn btn-success" href="">View</a>
                            <a class="btn btn-primary" href="">Edit</a>
                            <a class="btn btn-danger" href="">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection