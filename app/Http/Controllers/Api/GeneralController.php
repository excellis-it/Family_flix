<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\SubscriptionUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
    * @group General
    *
    * APIs for General
*/

class GeneralController extends Controller
{
    public $successStatus = 200;

    /**
    * Contact Api
    * @bodyParam user_name string required The name of the user. Example: John
    * @bodyParam user_email string required The email of the user. Example:
    * @bodyParam user_phone string required The phone of the user. Example: 1234567890
    * @bodyParam message string required The message of the user. Example: This is a test message
    * @response 200{
    * "status": true,
    *  "message": "Contact us details added successfully.",
    *  "success": {
    *       "user_name": "John",
    *       "user_email": "
    *       "user_phone": "1234567890",
    *       "message": "This is a test message",
    *       "id": 1
    *   }
    * }
    * @response 201{
    *  "error": "The user email field is required."
    * }

    */
    public function contactUs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_email' => 'required|email',
            'user_phone' => 'required|numeric',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first(), 'status' => false ], 200);
        }
        try{
            $contact_us = new ContactUs();
            $contact_us->user_name = $request->user_name;
            $contact_us->user_email = $request->user_email;
            $contact_us->user_phone = $request->user_phone;
            $contact_us->message = $request->message;
            $contact_us->save();

            return response()->json(['status' =>true, 'message' => 'Contact us details added successfully.','success' => $contact_us], $this->successStatus);
        } catch (\Exception $e) {
            return response()->json(['status' =>false, 'message' => 'Something went wrong, please try again.','error' => $e->getMessage()], 500);
        }
    }

    /** 
    * Subscribe Api
    * @bodyParam email string required The email of the user. Example:
    * @response 200{
    * "status": true,
    *  "message": "You have been subscribed successfully"
    * }
    * @response 201{
    *  "error": "The email has already been taken."
    * } 
    */

    public function subscribeUs(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscription_us,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first(), 'status' => false], 201);
        }
        try{
            $subscription_us = new SubscriptionUs();
            $subscription_us->email = $request->email;
            $subscription_us->save();

            return response()->json(['status' =>true, 'message' => 'You have been subscribed successfully'], $this->successStatus);

        } catch (\Exception $e) {
            return response()->json(['status' =>false, 'message' => 'Something went wrong, please try again.','error' => $e->getMessage()], 500);
        }
    }
}
