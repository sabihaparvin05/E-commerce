<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function list()
{
    $orders=Order::all();
    return view('admin.pages.order.list',compact('orders'));
}    
}
