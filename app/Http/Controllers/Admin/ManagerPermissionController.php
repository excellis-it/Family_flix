<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Collection;



class ManagerPermissionController extends Controller
{
    //
    public function index()
    {
        $roles = Role::where('name', '!=', 'ADMIN')->where('name', '!=', 'CUSTOMER')->where('name', '!=', 'AFFLIATE MARKETER')->paginate(15);
        return view('admin.manager_permission.list')->with(compact('roles'));
    }

    public function permissionAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $roles = Role::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('id', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%');
            })
            ->where('name', '!=', 'ADMIN')
            ->where('name', '!=', 'CUSTOMER')
            ->where('name', '!=', 'AFFLIATE MARKETER')
            ->orderBy('id', 'desc')
            ->paginate(15);

            return response()->json(['data' => view('admin.manager_permission.table', compact('roles'))->render()]);
        }
    }

    public function permissionCreate()
    {
        $permissions = Permission::all()->pluck('name', 'id')->toArray();
        return view('admin.manager_permission.create')->with(compact('permissions'));
    }

    public function permissionSubmit(Request $request)
    {
        
        $request->validate([
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);
        $role = Role::create(['name' => strtoupper($request['role_name']), 'guard_name' => 'web']);
        $permissions = $request['permissions'];
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }
        return back()->with('message', 'Role permission created successfully');
    }

    public function permissionEdit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->pluck('name', 'id')->toArray();
        return view('admin.manager_permission.edit')->with(compact('role','permissions'));
    }

    public function permissionUpdate(Request $request, $id)
    {
        
        $id = Crypt::decrypt($id);
        $request->validate([
            'role_name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required'
        ]);
        $role = Role::findOrFail($id);
        $role->name = strtoupper($request['role_name']);
        $permissions = $request['permissions'];
        $role->update();
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
