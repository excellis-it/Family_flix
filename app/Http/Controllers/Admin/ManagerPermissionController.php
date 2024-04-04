<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;


class ManagerPermissionController extends Controller
{
    //
    public function index()
    {
        $role = Role::where('name', 'MANAGER')->first();
        $permissions = Permission::all()->pluck('name', 'id')->toArray();
        return view('admin.manager_permission.list')->with(compact('role', 'permissions'));
        
    }

    public function permissionUpdate(Request $request, $id)
    {
       
        $id = Crypt::decrypt($id);
        $request->validate([
            'permissions' => 'required'
        ]);
        $role = Role::findOrFail($id);
        $permissions = $request['permissions'];
        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }

        return back()->with('message', 'Role permission updated successfully');
    }
   
}
