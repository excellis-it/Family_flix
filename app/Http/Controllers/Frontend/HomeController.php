<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCms;
use App\Models\Plan;
use App\Models\TopGrid;
use App\Models\OttService;
use App\Models\EntertainmentCms;
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
        $top_grids = TopGrid::orderBy('id','asc')->get();
        $ott_icons = OttService::orderBy('id','asc')->get();
        $entertainments = EntertainmentCms::orderBy('id','asc')->get();
        
        return view('frontend.home',compact('home_cms','plans','top_grids','ott_icons','entertainments'));
    }

    public function contactUs()
    {
        return view('frontend.contact');
    }

    public function aboutUs()
    {
        return view('frontend.about');
    }

    public function movies()
    {
        return view('frontend.movies');
    }

    public function shows()
    {
        return view('frontend.shows');
    }

    public function kids()
    {
        return view('frontend.kids');
    }

    public function pricing()
    {
       
        return view('frontend.pricing');
    }

    public function faqs()
    {
        return view('frontend.faqs');
    }

    public function termService()
    {
        return view('frontend.term-service');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy-policy');
    }


}
