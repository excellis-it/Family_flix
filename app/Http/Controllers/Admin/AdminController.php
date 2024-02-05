<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function admin()
    {
        if (Auth::check() && Auth::user()->hasRole('ADMIN')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8'
        ]);
        
       
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password] )) {
            $user = User::where('email', $request->email)->first();
            
            if ($user->hasRole('ADMIN')) {
                return redirect()->route('admin.dashboard');
            }else{
               
                Auth::logout();
                return redirect()->back()->with('error', 'Email id & password was invalid!');
            }
        } else {
            return redirect()->back()->with('error', 'Email id & password was invalid!');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $count = User::where('email', $request->email)->count();
        if ($count > 0) {
            return redirect()->back()->with('error', 'Email already exists');
        } else {
            $admin = new User;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->status = true;
            if ($request->hasFile('profile_picture')) {
                $request->validate([
                    'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);

                $file = $request->file('profile_picture');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $image_path = $request->file('profile_picture')->store('admin', 'public');
                $admin->profile_picture = $image_path;
            }
            $admin->save();
            $admin->assignRole('ADMIN');
            return redirect()->route('admin.index')->with('message', 'Admin has been added successfully');
        }
    }

    public function edit($id)
    {
        $admin = User::where('id', $id)->first();
        return response()->json(['admin' => $admin, 'message' => 'Admin details found successfully.']);
    }

    public function update(Request $request)
    {

        $request->validate([
            'edit_name' => 'required',
            'edit_email' => 'required',
        ]);

        $count = User::where('email', $request->edit_email)->where('id', '!=', $request->id)->count();
        if ($count > 0) {
            return redirect()->back()->with('error', 'Email already exists');
        } else {
            $user = User::where('id', $request->id)->first();
            $user->name =  $request->edit_name;
            $user->email =  $request->edit_email;
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $image_path = $request->file('profile_picture')->store('user', 'public');
                $user->profile_picture = $image_path;
            }
            $user->save();

            return redirect()->back()->with('message',  'Admin account has been successfully updated.');
        }
    }


    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('error', 'Admin has been deleted!');
    }
}
