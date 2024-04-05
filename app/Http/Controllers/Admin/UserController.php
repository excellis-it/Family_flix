<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['ADMIN', 'CUSTOMER', 'AFFLIATE MARKETER']);
        })->orderBy('id', 'desc')->paginate(15);

        return view('admin.users.list')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'ADMIN')->where('name', '!=', 'CUSTOMER')->where('name', '!=', 'AFFLIATE MARKETER')->paginate(15);
        return view('admin.users.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'role_name' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'status' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;

        if($request->hasFile('profile_picture')){
            $user->image = $this->imageUpload($request->file('profile_picture'), 'User')['filePath'];
        }
        $user->save();
        $role = Role::where('id',$request->role_name)->first();
        $user->assignRole($role->id);

        return redirect()->route('users.index')->with('message', 'User created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user_detail = User::find($id);
        // get user role from $user_detail
        $role_id = $user_detail->roles->first()->id;
        $roles = Role::where('name', '!=', 'ADMIN')->where('name', '!=', 'CUSTOMER')->where('name', '!=', 'AFFLIATE MARKETER')->paginate(15);
        return view('admin.users.edit')->with(compact('user_detail', 'roles','role_id'));
    }


    public function updateUser(Request $request)
    {
        //validate
        $request->validate([
            'role_name' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'status' => 'required',
        ]);
       
        $user_detail_update = User::find($request->id);
        $user_detail_update->name = $request->name;
        $user_detail_update->email = $request->email;
        $user_detail_update->phone = $request->phone;
        $user_detail_update->status = $request->status;
        if($request->password){
            $request->validate([
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
            ]);
            $user_detail_update->password = bcrypt($request->password);
        }

        if($request->hasFile('profile_picture')){
            $user_detail_update->image = $this->imageUpload($request->file('profile_picture'), 'User')['filePath'];
        }
        $user_detail_update->update();

        return redirect()->route('users.index')->with('message', 'User updated successfully');
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('message', 'User deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
