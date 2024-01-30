<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function list()
    {
        $brands = Brand::all();        
        return view('admin.pages.brand.list', compact('brands'));
    }

    public function create()
    {
        return view('admin.pages.brand.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(),
            [
                'brand_name' => 'required',
                'description' => 'required',
            ]
        );

        if ($validate->fails()) {
            notify()->error('Give the Valid information.');
            return redirect()->back();
        }

        $fileName = null;
        if ($request->hasFile('image')) {
            // dd($request->all());
            $file = $request->file('image');
            $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/uploads', $fileName);
        }

        Brand::create(
            [
                'name' => $request->brand_name,
                'logo' => $fileName,
                'description' => $request->description,
            ]
        );

        notify()->success('Brand create successful.');
        return redirect()->route('brand.list');
    }
}
