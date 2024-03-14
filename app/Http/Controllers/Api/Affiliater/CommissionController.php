<?php

namespace App\Http\Controllers\Api\Affiliater;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\UserSubscription;

/**
 * @group Listing APIs
 *
 * APIs for Commission Listing
 */

class CommissionController extends Controller
{

    /**
     * Commission Api
     * @authenticated
     * @response 200{
     * "status": true,
     *  "statusCode": 200,
     *  "data": [
     *      {
     *          "id": 1,
     *          "affiliate_id": 3,
     *          "customer_id": 1,
     *          "subscription_id": 1,
     *          "commission": "5.00",
     *          "created_at": "2021-05-27T06:50:50.000000Z",
     *          "updated_at": "2021-05-27T06:50:50.000000Z",
     *          "customer_details": {
     *              "id": 1,
     *              "name": "John Doe",
     *              "email": "
     *         }
     *    }
     * ]
     * }
     * @response 200{
     * "status": false,
     * "statusCode": 200,
     * "message": "No commission found!"
     * }
     * @response 401{
     * "status": false,
     * "statusCode": 401,
     * "error": "Unauthorised"
     * }
     */

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
