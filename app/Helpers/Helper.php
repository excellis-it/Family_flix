<?php

namespace App\Helpers;
use App\Models\PaypalCredential;

class Helper {

     public static function paypalCredential()
     {
        return PaypalCredential::where('status', 1)->first();
     }
}
