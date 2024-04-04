<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
    * @group Authentication
    *
    * APIs for Authentication
*/

class AuthController extends Controller
{
    //
    public $successStatus = 200;

    /**
     * Login Api
     * @bodyParam email string required The email of the user. Example: john@yopmail.com
     * @bodyParam password string required The password of the user. Example: 12345678
     * @response 200{
     * "status": true,
     *  "statusCode": 200,
     *  "data": {
     *       "auth_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzY3MWMyMjEwNTg0N2RmMmQ1YmU5YWVmYTEwMWY3YjA4MWM4ODk5OTU4ODk2ZTdlNWRhMmRkMTg5ZmM1ZTc4MmFjYmYzYmQ0NDkyZDA0MDUiLCJpYXQiOjE3MTAzOTYwMzMuNTMzMjY2LCJuYmYiOjE3MTAzOTYwMzMuNTMzMjY5LCJleHAiOjE3NDE5MzIwMzMuNTEwMDA1LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.AEf1NATUpiobMWd1AFoYXqGYDUDONeHU14daG21OyLSO69xpptoEujD_tfBZJYiS_mp4vlYvBqbEl8-LAlkmek81UKaALBkJD3CP4cbQiAjVSQI_xy9BVJiF3rJMHjouYClxWqM-JoiccX5NUB1RQzTgWhMIEQsKjZlEh3JVNiAiTRAKOq4Vdq_IB5j2W9pqvG9we_dYdgmzNbOcZFrFOhdFxwVMxpQRCvJwwKAiINsfV-yXuAWE2lFCSxGVh9U1Hv7bl-xu6x5F3lSvO_1FFSBFgVeDJbUpFAzqVnG8OfOkw6Yyj20N7wA3KbCxZ8tnofD88qP54kDec82zGjze7Cyx0H4fpGMr83skNNQy2iwHrVX04qqspaZEQRdsI26XX16ZliFGY3hZl8RZ7RW8ceXJVlsqv5RZw9XJcxp1CaDb5zThsjxUKpxApExXOZ0Rc6JmLeqAQHSF7n9Kpw0Oeu3CwQSD6UAzOkF-nqKJKR6AmEr1ewaT9nccvt546nVtgKcHDR6Wpni4wLBAw4DCiwUyLtfQhnueoNpnZvBHnLe-KyXFrLEse8yTETdo21Xk3Chk8DkjrIrwaMN16G_6SoTY7ZqCaVly2JPbiMtfVzqqRRxWnLIHNvbXS0a2iWNWpkI3UOWRSTKt2B2rVnbzY4Xfkwn_uzigPiUyovUZxks",
     *       "user": {
     *           "id": 3,
     *           "name": "test2 affiliater2",
     *           "email": "test1@yopmail.com",
     *           "status": "1"
     *       }
     *   }
     * }
     * @response 401{
     *  "status": false,
     *  "statusCode": 401,
     *  "error": "Invalid user & Password!"
     * }
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
            'password' => 'required|min:8',
        ]);
 
        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }
 
        try {
            if(Auth::attempt(['email'=> $request->email, 'password' => $request->password]))
            {
                $user = User::where('email', $request->email)->select('id', 'name', 'email', 'status')->first();
                if ($user->status == 1 && $user->hasRole('AFFLIATE MARKETER')) {
                    $data['auth_token'] = $user->createToken('accessToken')->accessToken;
                    $data['user'] = $user->makeHidden('roles');
                    return response()->json(['status' => true, 'statusCode' => 200, 'data' => $data], $this->successStatus);
                } else {
                    return response()->json(['status' => false, 'statusCode' => 200, 'error' => 'Invalid user & Password!'], 200);
                }
            } else {
                return response()->json(['status' => false, 'statusCode' => 200, 'error' => 'Invalid user & Password!'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }

     /**
     * Register Api
     * @bodyParam name string required The name of the user. Example: John Doe
     * @bodyParam email string required The email of the user. Example:
     * @bodyParam password string required The password of the user. Example: 12345678
     * @bodyParam confirm_password string required The confirm_password of the user. Example: 12345678
     * 
     * @response 200{
     *  "status": true,
     *   "statusCode": 200,
     *   "data": {
     *   "user": {
     *       "name": "test affiliaters",
     *       "email": "test123@yopmail.com",
     *       "phone": 8956237845,
     *       "status": 1,
     *       "updated_at": "2024-03-14T05:57:00.000000Z",
     *       "created_at": "2024-03-14T05:57:00.000000Z",
     *       "id": 4
     *   }
     *   },
     *   "message": "registered successfully"
     * }
     * 
     * @response 401{
     * "status": false,
     * "statusCode": 401,
     * "error": {
     * "message": [
     *       "The email has already been taken.",
     *       "The confirm password and password must match."
     *   ]
     * }
     * }
     * 
     */ 


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password', 
        ]);
       
        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email, 
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'status' => 1,
            ]);
            $user->assignRole('AFFLIATE MARKETER');
            $data['user'] = $user->makeHidden('roles');
            return response()->json(['status' => true, 'statusCode' => 200, 'data' => $data, 'message' => "registered successfully"], $this->successStatus);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }
}
  