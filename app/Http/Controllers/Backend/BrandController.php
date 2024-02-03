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
        $validate = Validator::make(
            $request->all(),
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


    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.pages.brand.edit', compact('brands'));
    }


    public function update(Request $request, $id)
    {
        $brands = Brand::find($id);

        if ($brands) {
            $fileName = $brands->logo;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/uploads', $fileName);
            }

            $brands->update([
                'name' => $request->name,
                'logo' => $fileName,
                'description' => $request->description,
            ]);

            notify()->success('Brands updated successfully.');
            return redirect()->route('brand.list');
        }
    }


    public function delete($id)
    {
        $brands = Brand::find($id);

        if($brands)
        {
            $brands->delete();
        }

        notify()->success('Brands deleted successfully.');
        return redirect()->back();
    }
}
