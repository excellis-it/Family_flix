<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\SubscriptionUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class GeneralController extends Controller
{
    public $successStatus = 200;
    public function contactUs(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_email' => 'required|email',
            'user_phone' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
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

    public function subscribeUs(Request $request)
    {
        //validation 
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscription_us,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
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
