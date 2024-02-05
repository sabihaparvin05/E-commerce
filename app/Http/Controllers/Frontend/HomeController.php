<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $products=Product::all();
        //dd($products->all());
        return view('frontend.pages.customer.home',compact('products'));
    }
}
