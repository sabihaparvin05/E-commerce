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


    public function searchProduct(Request $request)
    {
      //dd(request()->all());
      if($request->search)
      {
          $products=Product::where('name','LIKE','%'.$request->search.'%')->get();
          //select * from product where name like % shoe %;
      }else{
          $products=Product::all();
      }
      return view('frontend.pages.search.searchProduct',compact('products'));
     
    }
}


