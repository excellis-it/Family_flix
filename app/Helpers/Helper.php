<?php

namespace App\Helpers;
use App\Models\PaypalCredential;
use App\Models\StripeCredential;
use App\Models\UserSubscriptionRecurring;
use App\Models\Wallet;

class Helper {

    public static function paypalCredential()
    {
        return PaypalCredential::where('status', 1)->first();
    }

    public static function stripeCredential()
    {
        return StripeCredential::where('status', 1)->first();
    }

    public static function expireTo($date)
    {
        // how many day left to expire
        $now = time();
        $your_date = strtotime($date);
        $datediff = $your_date - $now;
        $days = floor($datediff / (60 * 60 * 24));
        return $days;
       
    }

    public static function adminWallet()
    {
        $admin_wallet = auth()->user()->wallet_balance;
        $admin_wallet_formatted = $admin_wallet ? $admin_wallet : '0.00';
        return $admin_wallet_formatted;
    }

    public static function affiliatorWallet($id)
    {
        $affiliator_wallet = auth()->user()->wallet_balance;
        $affiliate_wallet_formatted = $affiliator_wallet ? number_format($affiliator_wallet, 2, '.', '') : '0.00';
        return $affiliate_wallet_formatted;
    }

}
