<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\Plan;


class DashboardController extends Controller
{
    //
    public function index()
    {
        $count['subscriptions'] = UserSubscription::where('customer_details_id', auth()->user()->id)->count();
        $count['plans'] = Plan::count();
        
        return view('manager.dashboard',compact('count'));
    }

}
