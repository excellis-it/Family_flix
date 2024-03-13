<?php

namespace App\Http\Controllers\Api\Affiliater;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\UserSubscription;

class CommissionController extends Controller
{
    //

    public function commissionList(Request $request)
    {
        try {
            $affiliater_commissions = UserSubscription::where('affiliate_id', auth()->user()->id)->orderBy('id', 'desc')->with('customerDetails')->get();

            if ($affiliater_commissions->count() > 0) {
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $affiliater_commissions], 200);
            } else {
                return response()->json(['status' => false, 'statusCode' => 200, 'message' => 'No commission found!'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }


}
