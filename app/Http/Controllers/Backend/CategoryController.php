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
            notify()->error('Please enter the information.');
            return redirect()->back();
        }
       
            Category::create([
                'name'=>$request->category_name,
                'description'=>$request->category_description,
            ]);

            notify()->success('Created successful.');
            return redirect()->route('category.list');
    }

    public function view($id)
    {
        $category = Category::find($id);
        return view('admin.pages.category.view', compact('category'));
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.pages.category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if($category)
        {
            $category->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'status'=>$request->status,
            ]);
            notify()->success('Category updated successfully.');
            return redirect()->route('category.list');
        }
    }


    public function delete($id)
    {
        $category = Category::find($id);

        if($category)
        {
            $category->delete();
        }
        notify()->success('Category deleted successfully.');
        return redirect()->back();
    }
}
