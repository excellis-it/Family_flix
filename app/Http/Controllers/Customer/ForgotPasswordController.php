<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCustomerResetPasswordMail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ForgotPasswordController extends Controller
{
    //

    public function forgetPasswordShow()
    {
        return view('customer.auth.forgot-password');
    }

    public function forgetPassword(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email'
        ]);

        $count = User::where('email', $request->email)->role('CUSTOMER')->count();
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
            return redirect()->back()->with('message', "Please! check your mail to reset your password.");
        } else {
             return redirect()->back()->with('error', "Couldn't find your account!");
        }


    }

    public function resetPassword($id, $token)
    {
        
        $user = User::findOrFail(Crypt::decrypt($id));
        $resetPassword = PasswordReset::where('email', $user->email)->first();
        $newTime = Carbon::parse($resetPassword->created_at)->addHour();
        $newTime = $newTime->toDateTimeString();
        $now_time = Carbon::now()->toDateTimeString();

        if ($newTime >= $now_time) {
            return view('customer.auth.reset-password', compact('user', 'token'));
        } else {
            return redirect()->route('customer.forget-password.show')->with('error', "Your link has been expired!");
        }   
    }

    public function changePassword(Request $request)
    {
        
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);

        try {
            if ($request->id != '') {
                
                $id = $request->id;
                User::where('id', $id)->update(['password' => bcrypt($request->password)]);
                $now_time = Carbon::now()->toDateTimeString();
                return redirect()->route('customer.login')->with('message', 'Password has been changed successfully.');
            } else {
                abort(404);
            }
        }
        catch (\Throwable $th) {
            return redirect()->route('customer.login')->with('message', 'Something went wrong.');
        }
    }
}
