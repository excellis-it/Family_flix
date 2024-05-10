<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCodeResetPassword;
use App\Mail\SendCustomerResetPasswordMail;
use Illuminate\Support\Str;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Crypt; 

/**
    * @group Forget Password 
    *
    * APIs for Forget Password 
*/

class ForgotPasswordController extends Controller
{
    //

    public $successStatus = 200;
    
    /**forget password for affiliater
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @response {
     * "status": true,
     * "message": "Please! check your mail to reset your password.",
     * "status_code": 200
     * }
     * @response 201 {
     * "status": false,
     * "error": "Couldn't find your account!",
     * "status_code": 201
     * }
     * @response 401 {
     * "status": false,
     * "error": "The given data was invalid.",
     * 
     *  }
     */

    public function affiForgotPassword(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email'    => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        try {
            $count = User::where('email', $request->email)->role(['AFFLIATE MARKETER'])->count();
            if ($count > 0) {
                $user = User::where('email', $request->email)->select('id', 'name', 'email')->first();
                PasswordReset::where('email', $request->email)->delete();
                $id = Crypt::encrypt($user->id);
                $token = Str::random(20) . 'pass' . $user->id;

                PasswordReset::create([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);

                $details = [
                    'id' => $id,
                    'token' => $token
                ];

                Mail::to($request->email)->send(new SendCodeResetPassword($details));
                return response()->json(['message' => "Please! check your mail to reset your password.", 'status' => true], $this->successStatus);
            } else {
                return response()->json(['error' => "Couldn't find your account!", 'status' => false], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status' => false], 401);
        }
    }

    /**forget password for customer
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @response {
     * "status": true,
     * "message": "Please! check your mail to reset your password.",
     * "status_code": 200
     * }
     * @response 201 {
     * "status": false,
     * "error": "Couldn't find your account!",
     * "status_code": 201
     * }
     * @response 401 {
     * "status": false,
     * "error": "The given data was invalid.",
     * 
     *  }
     */

    public function customerForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        try {
            $count = User::where('email', $request->email)->role(['CUSTOMER'])->count();
            if ($count > 0) {
                $user = User::where('email', $request->email)->select('id', 'name', 'email')->first();
                PasswordReset::where('email', $request->email)->delete();
                $id = Crypt::encrypt($user->id);
                $token = Str::random(20) . 'pass' . $user->id;

                PasswordReset::create([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);

                $details = [
                    'id' => $id,
                    'token' => $token
                ];

                Mail::to($request->email)->send(new SendCustomerResetPasswordMail($details));
                return response()->json(['message' => "Please! check your mail to reset your password.", 'status' => true], $this->successStatus);
            } else {
                return response()->json(['error' => "Couldn't find your account!", 'status' => false], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
