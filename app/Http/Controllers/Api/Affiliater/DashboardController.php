<?php

namespace App\Http\Controllers\Api\Affiliater;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;

/**
 * @group Affiliater dashboard
 */
class DashboardController extends Controller
{
    /**
     * Dashboard Api
     * @authenticated
     * @response 200{
     *     "success": {
     *        "total_commissions": 1,
     *       "total_commision_amount": 100,
     *      "commision_amount_this_month": 100,
     *     "commision_amount_this_week": 100
     *   }
     * }
     * @response 401{
     *   "error": "Unauthorised"
     * }
     */

    public function dashboard(Request $request)
    {
        try{
            $count['total_commissions'] = UserSubscription::where('affiliate_id', auth()->user()->id)->count();
            $count['total_commision_amount'] = UserSubscription::where('affiliate_id', auth()->user()->id)->sum('affiliate_commission');
            $count['commision_amount_this_month'] = UserSubscription::where('affiliate_id', auth()->user()->id)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('affiliate_commission');
            $count['commision_amount_this_week'] = UserSubscription::where('affiliate_id', auth()->user()->id)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('affiliate_commission');

            return response()->json(['message' => 'Affiliator dashboard details found successfully.','data' => $count, 'statusCode' => 200, 'status' => true]);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
