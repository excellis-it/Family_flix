<?php

namespace App\Http\Controllers\Api\Affiliater;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Traits\ImageTrait;
use Crypt;

class ProfileController extends Controller
{
    //
    use ImageTrait;
    public $successStatus = 200;

    /* 
    * profileDetails
    * @param:

    * @return: User details
    * 
    */

    public function profileDetails(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->select('id','name','email','phone')->first();
            if($user != '')
            {
                return response()->json(['message' => 'User details found successfully.','success' => $user, 'statusCode' => 200], $this->successStatus);
            }
            else
            {
                return response()->json(['error' => 'User not found!', 'statusCode' => 200], $this->successStatus);
            }
            
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function profileUpdate(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
        }
        try {
            $user = User::where('id', Auth::user()->id)->first();
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
            return response()->json(['message' => 'Affiliater details updated successfully.','success' => $user], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function affiliateLink(Request $request)
    {
        try{
           
            $create_link = url('/pricing/'.Crypt::encrypt(Auth::user()->id));
            return response()->json(['message' => 'Affiliate link created successfully.','success' => $create_link], $this->successStatus);
        }catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
