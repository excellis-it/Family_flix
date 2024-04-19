<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group Subscription
 *
 * APIs for Subscription List
 */

class SubscriptionController extends Controller
{
    /**
     * Subscriptions Api
     * @authenticated
     * @response 200{
     * "status": true,
     *  "statusCode": 200,
     * "data": [
     *   {
     *       "id": 14,
     *       "customer_details_id": 17,
     *       "customer_id": 30,
     *       "affiliate_id": "4",
     *       "payment_type": "paypal",
     *       "plan_name": "Starter",
     *       "plan_price": "25",
     *       "coupan_code": null,
     *       "coupan_discount": null,
     *       "coupan_discount_type": null,
     *       "sub_total": "25",
     *       "total": "25",
     *       "affiliate_commission": null,
     *       "additional_information": "dfgdf",
     *       "created_at": "2024-04-05T12:58:16.000000Z",
     *       "updated_at": "2024-04-05T12:58:16.000000Z",
     *       "affiliate": {
     *           "id": 4,
     *           "name": "test affi",
     *           "email": "affi@yopmail.com",
     *           "phone": "7894561236",
     *           "email_verified_at": null,
     *           "image": null,
     *           "status": "1",
     *           "created_at": "2024-04-03T06:47:51.000000Z",
     *           "updated_at": "2024-04-03T06:47:51.000000Z"
     *       }
     *   }
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
    
    public function subscriptionList(Request $request)
    {
        
        try {
            $user_subscriptions = UserSubscription::where('customer_id', auth()->user()->id)->orderBy('id', 'desc')->with('affiliate')->get();

            if ($user_subscriptions->count() > 0) {
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $user_subscriptions], 200);
            } else {
                return response()->json(['status' => false, 'statusCode' => 200, 'message' => 'No Subscription found!'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }
}
