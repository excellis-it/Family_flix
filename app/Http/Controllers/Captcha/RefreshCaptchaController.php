<?php

namespace App\Http\Controllers\Captcha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RefreshCaptchaController extends Controller
{
    //
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
