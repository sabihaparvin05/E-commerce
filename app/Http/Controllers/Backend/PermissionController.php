<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function permission($roleId)
    {
        $all_permission = Permission::all();
        $role = Role::with('permissions')->find($roleId);
        // dd($all_permission);
        return view('admin.pages.role.assign', compact('all_permission', 'role'));
    }


    public function assignPermission(Request $request, $roleId)
    {
        // dd($request->all());

        RolePermission::where('role_id', $roleId)->delete();
        
        foreach($request->permissions as $permission_id){
            RolePermission::create([
                'role_id'=>$roleId,
                'permission_id'=>$permission_id,
            ]);
        }

        notify()->success('Permission assigned successful.');
        return redirect()->back();
    }
}
