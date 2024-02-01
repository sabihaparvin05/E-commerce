<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function list()
    {
        $roles = Role::all();
        return view('admin.pages.role.list', compact('roles'));
    }


    public function create()
    {
        return view('admin.pages.role.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',        
        ]);

        if($validate->fails()) {
            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }

        Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        notify()->success('Role created successful.');
        return redirect()->route('role.list');
    }

    public function edit($roleId)
    {
        $roles = Role::find($roleId);
        // dd($roles->id);
        return view('admin.pages.role.edit', compact('roles'));
    }

    public function update(Request $request, $roleId)
    {
        $roleUpdate = Role::find($roleId);
        // dd($roleUpdate, $request->all());

        $roleUpdate->update([
            'name'=> $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        notify()->success('Role updated successfully.');
        return redirect()->route('role.list');
    }

    public function delete($roleId)
    {
        $roleId = Role::find($roleId);

        if($roleId)
        {
            $roleId->delete();
        }

        notify()->success('Role deleted successfully.');
        return redirect()->back();
    }

    public function roleAssign($id)
    {
        $roleAssign = Role::find($id);
        return view('admin.pages.role.assign', compact('roleAssign'));
    }
}
