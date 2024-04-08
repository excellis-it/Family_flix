<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //

    public $successStatus = 200;

    public function accountDetails(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->select('id','name','email','phone')->first();
            if($user != '')
            {
                return response()->json(['message' => 'User details found successfully.','data' => $user, 'statusCode' => 200, 'status' => true], $this->successStatus);
            }
            else
            {
                return response()->json(['error' => 'User not found!', 'statusCode' => 200, 'status' => false]);
            }
            
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function accountUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first(), 'status' => false], 200);
        }
        try {
            $user = User::where('id', Auth::user()->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->password) {
                $request->validate([
                    'password' => 'required|min:8|password_confirmation',
                ]);
                $user->password = Hash::make($request->password);
            }
            if ($request->hasFile('image')) {
                if ($user->image) {
                    $currentImageFilename = $user->image; // get current image name
                    Storage::delete('app/' . $currentImageFilename);
                }
                $user->image = $this->imageUpload($request->file('image'), 'Customer')['filePath'];
            }
            $user->save();
            return response()->json(['message' => 'Customer details updated successfully.','data' => $user, 'status'=> true], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        } 
    }
}
