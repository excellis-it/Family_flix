<?php

namespace App\Http\Controllers\AffiliateMarketer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.affiliate-marketer.dashboard');
    }
}
