<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SubscriptionController extends Controller
{
    //
    public function subscriptionList(Request $request)
    {
        
        try {
            $user_subscriptions = UserSubscription::where('customer_id', auth()->user()->id)->orderBy('id', 'desc')->with('affiliate')->get();

            if ($user_subscriptions->count() > 0) {
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $user_subscriptions], 200);
            } else {
                return response()->json(['status' => false, 'statusCode' => 200, 'message' => 'No commission found!'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }
}
