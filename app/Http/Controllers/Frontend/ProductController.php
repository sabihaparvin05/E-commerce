<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function singleProductView($productId)
    {
        $singleProduct=Product::with(['category','brand'])->find($productId);

        return view('frontend.pages.product.productView',compact('singleProduct'));
    }
}
