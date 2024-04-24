<?php

namespace App\Helpers;
use App\Models\PaypalCredential;

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
}
