<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class ManagerPermissionController extends Controller
{
    //
    public function index()
    {
        $role = Role::where('name', 'MANAGER')->first();
        $permissions = Permission::all()->pluck('name', 'id')->toArray();
        return view('admin.manager_permission.list')->with(compact('role', 'permissions'));
        
    }

    public function permissionUpdate(Request $request)
    {
        return $request->all();
        $role = Role::findById(request('role_id'));
        $role->syncPermissions(request('permissions'));
        return redirect()->back()->with('success', 'Permission updated successfully');
    }
   
}
