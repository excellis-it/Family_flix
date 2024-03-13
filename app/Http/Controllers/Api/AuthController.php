<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public $successStatus = 200;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
            'password' => 'required|min:8',
        ]);
 
        if ($validator->fails()) {
            $errors['message'] = [];
            $data = explode(',', $validator->errors());
 
            for ($i = 0; $i < count($validator->errors()); $i++) {
                 // return $data[$i];
                 $dk = explode('["', $data[$i]);
                 $ck = explode('"]', $dk[1]);
                 $errors['message'][$i] = $ck[0];
            }
            return response()->json(['status' => false, 'statusCode' => 401,  'error' => $errors], 401);
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
                    return response()->json(['status' => false, 'statusCode' => 401, 'error' => 'Invalid user & Password!'], 401);
                }
            } else {
                return response()->json(['status' => false, 'statusCode' => 401, 'error' => 'Invalid user & Password!'], 401);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }


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
            $errors['message'] = [];
            $data = explode(',', $validator->errors());

            for ($i = 0; $i < count($validator->errors()); $i++) {
                $dk = explode('["', $data[$i]);
                $ck = explode('"]', $dk[1]);
                $errors['message'][$i] = $ck[0];
            }
            return response()->json([ 'status' => false ,'statusCode' => 401, 'error' => $errors], 401);
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
  