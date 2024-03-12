<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class GeneralController extends Controller
{

    public function contactUs(Request $request)
    {
        //validation 
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'user_phone' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 201);
        }

        $contact_us = new ContactUs();
        $contact_us->user_name = $request->user_name;
        $contact_us->user_email = $request->user_email;
        $contact_us->user_phone = $request->user_phone;
        $contact_us->message = $request->message;
        $contact_us->save();

        return response()->json(['message' => 'Your message has been sent successfully'], 200);
    }
}
