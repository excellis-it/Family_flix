<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //

    use ImageTrait;

    public function customerProfile()
    {
        return view('customer.profile');
    }

    public function customerProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8|same:password',
        ]);

        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Profile picture must be an image');
            }
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            if ($user->image) {
                $currentImageFilename = $user->image; // get current image name
                Storage::delete('app/' . $currentImageFilename);
            }
            $user->image = $this->imageUpload($request->file('image'), 'Customer')['filePath'];
        }

        //password update
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->update();
        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function customerPassword()
    {
        return view('customer.change-password');
    }

    public function customerPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8|password',
            'new_password' => 'required|min:8|different:old_password',
            'confirm_password' => 'required|min:8|same:new_password',

        ], [
            'old_password.password' => 'Old password is not correct',
        ]);

        $data = User::find(Auth::user()->id);
        $data->password = Hash::make($request->new_password);
        $data->update();
        return redirect()->back()->with('message', 'Password updated successfully.');
    }
}
