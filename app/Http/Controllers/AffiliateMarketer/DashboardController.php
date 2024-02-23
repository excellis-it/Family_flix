<?php

namespace App\Http\Controllers\AffiliateMarketer;

use App\Http\Controllers\Controller;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $count['total_commissions'] = UserSubscription::where('affiliate_id', auth()->user()->id)->count();
        $count['total_commision_amount'] = UserSubscription::where('affiliate_id', auth()->user()->id)->sum('affiliate_commission');
        $count['commision_amount_this_month'] = UserSubscription::where('affiliate_id', auth()->user()->id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('affiliate_commission');
        $count['commision_amount_this_week'] = UserSubscription::where('affiliate_id', auth()->user()->id)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('affiliate_commission');
        return view('frontend.affiliate-marketer.dashboard')->with(compact('count'));
    }
}
