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


/**
 * @group Affiliater Profile
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
     *          "email_verified_at": null,
     *          "phone": "1234567890",
     *          "image": "Affiliate Marketer/1710396979_29689_c7ca91b4-b2eb-42b3-a317-58d00bb96190.png",
     *          "created_at": "2021-05-27T06:50:50.000000Z",
     *          "updated_at": "2021-05-27T06:50:50.000000Z"
     *      }
     * }
     *
     * @response 401{
     *    "error": "Unauthorised"
     * }
     */

    public function profileDetails(Request $request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();
            if($user != '')
            {
                return response()->json(['message' => 'Affiliator details found successfully.','data' => $user, 'statusCode' => 200, 'status' => true], $this->successStatus);
            }
            else
            {
                return response()->json(['error' => 'Affiliator not found!', 'statusCode' => 200, 'status' => false]);
            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    /**
     * Update Profile Api
     * @authenticated
     * @bodyParam name string required The name of the user. Example: John Doe
     * @bodyParam phone string required The phone of the user. Example: +1 1234 567 890
<<<<<<< HEAD
=======
     * @bodyParam address string required The address of the user. Example: USA,678
>>>>>>> c1785ddb5e90245089796b4a8046a3bd1939716d
     * @response 200{
     *   "message": "Affiliater details updated successfully.",
     *   "data": {
     *       "id": 3,
     *       "name": "test2 affiliater2",
     *       "email": "test1@yopmail.com",
     *       "phone": "1231231231",
     *       "email_verified_at": null,
     *       "image": "Affiliate Marketer/1710396979_29689_c7ca91b4-b2eb-42b3-a317-58d00bb96190.png",
     *       "status": "1",
     *       "created_at": "2024-03-13T12:57:34.000000Z",
     *       "updated_at": "2024-03-14T06:16:19.000000Z"
     *   }
     * }
     */

    public function profileUpdate(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first(), 'status' => false], 200);
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
            return response()->json(['message' => 'Affiliater details updated successfully.','data' => $user, 'status'=> true], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    /**
    * AffiliateLink Api
    * @authenticated
    * @response 200{
    *  "message": "Affiliate link created successfully.",
    *  "data": "http://127.0.0.1:8001/pricing/eyJpdiI6IkJZQnQ1NTNUR0RwOGNKK3RTWURJN2c9PSIsInZhbHVlIjoieE9rbkFxWGUxKzRucE92N3VOTCtrUT09IiwibWFjIjoiYzJiYzQzMGUyNTIyNmU3MmYyYjdkMzhmODgzZWE4MmYxNThkYWUyMDIzNmI1MTA0NWFhMTAzZWFhYTk3OTIxNyIsInRhZyI6IiJ9",
    *  "status": true
    * }
    */

    public function affiliateLink(Request $request)
    {
        try{

            $create_link = url('/pricing/'.Crypt::encrypt(Auth::user()->id));
            return response()->json(['message' => 'Affiliate link created successfully.','data' => $create_link, 'status'=>true], $this->successStatus);
        }catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
