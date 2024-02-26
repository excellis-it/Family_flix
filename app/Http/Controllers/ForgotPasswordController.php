<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgetPasswordShow()
    {
        return view('auth.forgot-password');
    }

    public function forgetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        PasswordReset::where('email', $request->email)->delete();
        $id = base64_encode($user->id);
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
        // return $request->email;
        // Mail::to($request->email)->send(new SendCodeResetPassword($details));
        return redirect()->back()->with('message', "Please! check your mail to reset your password.");
    }

    public function resetPassword($id, $token)
    {

        $user = User::findOrFail(base64_decode($id));
        $resetPassword = PasswordReset::where('email', $user->email)->first();
        $newTime =  date('h:i A', strtotime( $resetPassword->created_at->addHour()));

        return view('frontend.auth.reset-password', compact('user', 'token'));

    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password'
        ]);
        try {
            if ($request->id != '') {
                $id = base64_decode($request->id);
                User::where('id', $id)->update(['password' => bcrypt($request->password)]);
                $now_time = Carbon::now()->toDateTimeString();
                return redirect()->route('login')->with('message', 'Password has been changed successfully.');
            } else {
                abort(404);
            }
        }
        catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('login')->with('message', $th->getMessage());
        }

    }
}
