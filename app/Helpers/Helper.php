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
        return $admin_wallet ? $admin_wallet : 0;
    }

    public static function affiliatorWallet($id)
    {
        $affiliator_wallet = Wallet::where('user_id',$id)->sum('balance');
        return $affiliator_wallet ? $affiliator_wallet : 0;
    }


}
