<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Plan;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $count['products'] = Product::count();
        $count['affiliators'] = User::role('AFFLIATE MARKETER')->count();
        $count['plans'] = Plan::count();
        $count['subscriptions'] = UserSubscription::count();

        return view('admin.dashboard',compact('count'));
    }

}
