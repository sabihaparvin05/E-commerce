<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productsUnderCategory($c_id)
{
    $productsUnderCategory=Product::where('category_id',$c_id)->get();
    return view('frontend.pages.product.productUnderCategory',compact('productsUnderCategory'));
}
}