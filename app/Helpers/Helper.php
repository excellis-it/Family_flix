<?php

namespace App\Helpers;
use App\Models\PaypalCredential;
use App\Models\Wallet;

class Helper {

     public static function paypalCredential()
     {
        return PaypalCredential::where('status', 1)->first();
     }

    public static function expireTo($date)
    {
        // how many day left to expire
        $now = time();
        $your_date = strtotime($date);
        $datediff = $your_date - $now;
        $days = floor($datediff / (60 * 60 * 24));
        return $days;
        // if ($days == 0) {
        //     return 'Today';
        // } else if ($days == 1) {
        //     return 'Tomorrow';
        // } else if ($days < 0) {
        //     return false;
        // } else {
        //     return $days . ' days';
        // }
    }

    public static function adminWallet()
    {
        $admin_wallet = Wallet::where('user_type','admin')->sum('balance');
        
        $admin_wallet_formatted = $admin_wallet ? number_format($admin_wallet, 2, '.', '') : '0.00';
        return $admin_wallet_formatted;
    }

    public static function affiliatorWallet($id)
    {
        $affiliator_wallet = Wallet::where('user_id',$id)->sum('balance');
        $affiliate_wallet_formatted = $affiliator_wallet ? number_format($affiliator_wallet, 2, '.', '') : '0.00';
        return $affiliate_wallet_formatted;
    }


}
