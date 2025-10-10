<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class AuthController extends Controller
{
    //

    public function register()
    {
        return view('customer.auth.register');
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'full_name'     => 'required',
            'email'    => 'required|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'phone' => 'required|numeric|unique:users,phone',
            'captcha' => 'required|captcha'
        ], [
            'email.email' => 'The email format is invalid.',
            'captcha.captcha'=>'Invalid captcha code.'
        ]);

        $input = $request->all();
        $user = new User;
        $user->name = $input['full_name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->password = bcrypt($input['password']);
        $user->status = 1;
        $user->save();
        $user->assignRole('CUSTOMER');

        $maildata = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $input['password'],
        ];
        Mail::to($request->email)->send(new WelcomeMail($maildata));

        return redirect()->route('customer.login')->with('message', 'Your account has been created successfully.');
    }

    public function customerLogin()
    {
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            return redirect()->route('customer.subscription');
        } else {
            return view('customer.auth.login');
        }
    }

    public function loginCheck(Request $request)
    {

        $request->validate([
            'email'    => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
            'captcha' => 'required|captcha'
        ],
        ['captcha.captcha'=>'Invalid captcha code.']);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            if ($user->hasRole('CUSTOMER') && $user->status == 1) {
                return redirect()->route('customer.subscription');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            return redirect()->back()->with('error', 'Email id & password was invalid!');
        }
    }



    public function customerLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
