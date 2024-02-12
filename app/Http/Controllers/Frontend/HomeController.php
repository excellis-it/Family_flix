<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCms;
use App\Models\Plan;
use Auth;
use Session;

use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    //
    public function home()
    {
        $home_cms = HomeCms::first();
        $plans = Plan::orderBy('plan_order','asc')->with('Specification')->get();
        return view('frontend.home',compact('home_cms','plans'));
    }
}
