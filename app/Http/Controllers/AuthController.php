<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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
       
        return view('frontend.auth.register');
    }

    public function registerStore(Request $request)
    {
       
        $request->validate([
            'first_name'     => 'required',
            'last_name'     => 'required',
            'email'    => 'required|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ], [
            'email.email' => 'The email format is invalid.',
        ]);

        $input = $request->all();
        $user = new User;
        $user->name = $input['first_name'].' '.$input['last_name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->status = 1;
        $user->save();
        $user->assignRole('CUSTOMER');

        $maildata = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        Mail::to($request->email)->send(new WelcomeMail($maildata));
        
        return redirect()->route('login')->with('message', 'Your account has been created successfully.');
    }
    
    public function login()
    { 
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            return redirect()->route('user.dashboard');
        } else {
            return view('frontend.auth.login');
        }
        // return view('frontend.auth.login');
    }
    
    public function loginCheck(Request $request)
    {
       
        $request->validate([
            'email'    => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8'
        ]);
        
       
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password] )) {
            $user = User::where('email', $request->email)->first();
            
            if($user->hasRole('CUSTOMER') && $user->status == 1){
                //user has plans then go to dashboard
                $check_user_plan = Payment::where('user_id', $user->id)->first();
                if($check_user_plan){
                    Auth::login($user);
                    return redirect()->route('my-plan.list');
                }else{
                    //user has no plans then go to plans page
                    
                    return redirect()->route('pricing');
                }
                
            } else{
               
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
}
