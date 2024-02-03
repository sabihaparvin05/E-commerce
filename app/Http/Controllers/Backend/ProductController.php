<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::with(['category', 'brand'])->get();
        // dd($products);
        return view('admin.pages.product.list', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.pages.product.create', compact('brands', 'categories'));
    }


    public function view($id)
    {
        $products = Product::find($id);
        return view('admin.pages.product.view', compact('products'));
    }


    public function edit($id)
    {
        $products = Product::find($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.pages.product.edit', compact('products', 'brands', 'categories'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $products = Product::find($id);

        if ($products) {
            $fileName = $products->image;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();

                $file->storeAs('/uploads', $fileName);
            }

            $products->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'name' => $request->product_name,
                'price' => $request->price,
                'description' => $request->description,
                'stock' => $request->stock,
                'status' => $request->status,
                'image' => $fileName
            ]);

            notify()->success('Product updated successfully.');
            return redirect()->route('product.list');
        }
    }


    public function delete($id)
    {
        $products=Product::find($id);

        if($products){
            $products->delete();
        }
        notify()->success('Product deleted successfully.');
        return redirect()->back();
    }

    
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'brand_id' => 'required',
            'category_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required|numeric|min:10',
            'product_stock' => 'required|numeric',
        ]);

        if ($validate->fails()) {

            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/uploads', $fileName);
        }

        Product::create([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'name' => $request->product_name,
            'price' => $request->product_price,
            'description' => $request->product_description,
            'stock' => $request->product_stock,
            'image' => $fileName
        ]);

        notify()->success('Product created successful.');
        return redirect()->route('product.list');
    }
}
