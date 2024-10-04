<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\AffiliaterWelcomeMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function admin()
    {
        if (Auth::check() && Auth::user()->hasRole('ADMIN')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function adminLogin()
    {
        if (Auth::check() && Auth::user()->hasRole('ADMIN')) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('admin.auth.login');
        }
    }

    public function register()
    {
        return view('frontend.affiliate-marketer.auth.register');
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'full_name'     => 'required',
            'email'    => 'required|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'phone' => 'required|numeric',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'captcha' => 'required|captcha'
        ], [
            'email.email' => 'The email format is invalid.',
            'captcha.captcha'=>'Invalid captcha code.'
        ]);



        if ($request->input('captcha') !== session('captcha')) {
            return back()->withErrors(['captcha' => 'Invalid CAPTCHA. Please try again.']);
        }

        $input = $request->all();
        $user = new User;
        $user->name = $input['full_name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->password = bcrypt($input['password']);
        $user->status = 1;
        $user->save();
        $user->assignRole('AFFLIATE MARKETER');

        $maildata = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        Mail::to($request->email)->send(new AffiliaterWelcomeMail($maildata));

        return redirect()->route('affiliate-marketer.login')->with('message', 'Your account has been created successfully.');
    }

    public function login()
    {
        if (Auth::check() && Auth::user()->hasRole('AFFLIATE MARKETER')) {
            return redirect()->route('affliate-marketer.dashboard');
        } else {
            return view('frontend.affiliate-marketer.auth.login');
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
            if ($user->hasRole('AFFLIATE MARKETER') && $user->status == 1) {
                return redirect()->route('affiliate-marketer.dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is deactivate!');
            }
        } else {
            return redirect()->back()->with('error', 'Email id & password was invalid!');
        }
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function affliateLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function anyUserLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

   
}
