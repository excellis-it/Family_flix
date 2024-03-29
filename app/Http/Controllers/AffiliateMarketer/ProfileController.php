<?php

namespace App\Http\Controllers\AffiliateMarketer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use ImageTrait;

    public function index()
    {
        return view('frontend.affiliate-marketer.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|unique:users,phone,' . auth()->user()->id,
        ],[
            'phone.unique' => 'The phone has already been taken.',
            'phone.numeric' => 'The phone must be a number.',
            'name.required' => 'The full name field is required.',
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
        if ($request->hasFile('image')) {
            if ($user->image) {
                $currentImageFilename = $user->image; // get current image name
                Storage::delete('app/' . $currentImageFilename);
            }
            $user->image = $this->imageUpload($request->file('image'), 'Affiliate Marketer')['filePath'];
        }
        $user->save();
        return redirect()->back()->with('message', 'Profile updated successfully');
    }

    public function password()
    {
        return view('frontend.affiliate-marketer.change-password');
    }

    public function passwordUpdate(Request $request)
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
