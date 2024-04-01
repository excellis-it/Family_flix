<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $count['subscriptions'] = UserSubscription::where('customer_details_id', auth()->user()->id)->count();
        $count['plans'] = Plan::count();
        
        return view('customer.dashboard',compact('count'));
    }
}
