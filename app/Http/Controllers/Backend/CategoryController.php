<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all();
        return view('admin.pages.category.list', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validate=Validator::make($request->all(),
        [
            'category_name'=>'required',
            'category_description'=>'required',
        ]);

        if($validate->fails())
        {
            // dd($validate->getMessageBag());
            return redirect()->back();
        }
       
            Category::create([
                'name'=>$request->category_name,
                'description'=>$request->category_description
            ]);

            notify()->success('Created successful.');
            return redirect()->route('category.list');
    }
}
