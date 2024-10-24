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
        $affi_commission = UserSubscription::where('affiliate_id', auth()->user()->id)->sum('affiliate_commission');
        $affi_commission_monthly =  UserSubscription::where('affiliate_id', auth()->user()->id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('affiliate_commission');
        $affi_commission_weekly = UserSubscription::where('affiliate_id', auth()->user()->id)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('affiliate_commission');
        
        $count['total_commision_amount'] = number_format($affi_commission, 2, '.', '');
        $count['commision_amount_this_month'] = number_format($affi_commission_monthly, 2, '.', '');
        $count['commision_amount_this_week'] = number_format($affi_commission_weekly, 2, '.', '');
        
        return view('frontend.affiliate-marketer.dashboard')->with(compact('count'));
    }
}
