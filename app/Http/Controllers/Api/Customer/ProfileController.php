<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Traits\ImageTrait;
use Crypt;

/**
 * @group Customer Profile 
 *
 * APIs for Profile Details
 */

class ProfileController extends Controller
{
    //
    use ImageTrait;
    public $successStatus = 200;

     /**
     * Details Api
     * @authenticated
     * @response 200{
     *      "success": {
     *          "id": 1,
     *          "name": "John Doe",
     *          "email": "john@yopmail.com",
     *        "email_verified_at": null,
     *       "created_at": "2021-05-27T06:50:50.000000Z",
     *     "updated_at": "2021-05-27T06:50:50.000000Z"
     *  }
     * }
     *  
     * @response 401{
     *    "error": "Unauthorised"
     * }
     */

    public function accountDetails(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();
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

    /**
     * Update-Profile Api
     * @authenticated
     * @bodyParam name string required The name of the user. Example: John Doe
     * @bodyParam email string required The email of the user. Example: whiteglovecomics@gmail.com
     * @response 200{
     *   "message": "Customer details updated successfully.",
     *   "data": {
     *       "id": 3,
     *       "name": "test2 affiliater2",
     *       "email": "test1@yopmail.com",
     *       "phone": "1231231231",
     *       "email_verified_at": null,
     *       "image": "Customer/1710396979_29689_c7ca91b4-b2eb-42b3-a317-58d00bb96190.png",
     *       "status": "1",
     *       "created_at": "2024-03-13T12:57:34.000000Z",
     *       "updated_at": "2024-03-14T06:16:19.000000Z"
     *   }
     * }
     */

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
