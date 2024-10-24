<?php

namespace App\Http\Controllers\Api\Affiliater;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

/**
 * @group Wallet - History
 */

class WalletController extends Controller
{
    /**
     * Wallet History Api
     * @authenticated
     * @response 200{
     * "status": true,
     * "statusCode": 200,
     * "total_amount": 100,
     * "wallet_history": [
     *    {
     *       "id": 1,
     *      "user_id": 1,
     *     "user_subscription_id": 1,
     *    "balance": "100.00",
     *  "created_at": "2021-05-27T06:50:50.000000Z",
     * "updated_at": "2021-05-27T06:50:50.000000Z",
     * "subscription": {
     *   "id": 1,
     * "customer_details_id": 1,
     * "affiliate_id": 3,
     * "payment_type": "Stripe",
     * "plan_name": "Basic",
     * "plan_price": "100.00",
     * "coupan_code": "ABC",
     * "coupan_discount": "10.00",
     * "coupan_discount_type": "Percentage",
     * "sub_total": "90.00",
     * "total": "90.00",
     * "additional_information": "Test"
     * }
     * }
     * ]
     * }
     * @response 401{
     * "status": false,
     * "statusCode": 401,
     * "error": "Unauthorised"
     * }
     * @response 200{
     * "status": false,
     * "statusCode": 200,
     * "message": "No wallet history found!"
     * }
     * @return \Illuminate\Http\Response
     * 
     */
    public function walletList(Request $request)
    {
        try{
            $sum_value = Wallet::where('user_id', Auth::user()->id)->sum('balance');
            $wallet_sum = number_format($sum_value, 2, '.', '');
            $wallets = Wallet::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->with('subscription','subscription.customer')->get();
            if ($request->search) {
                $query = $request->get('search', ''); // Default to empty string if not set
                $wallets = Wallet::query()
                    ->where('user_id', Auth::user()->id)
                    ->where(function ($q) use ($query) {
                        $q->where('balance', 'like', '%' . $query . '%')
                            ->orWhere('wallet_id', 'like', '%' . $query . '%')                  
                                ->orWhereHas('subscription', function ($q) use ($query) {
                                $q->where('plan_name', 'like', '%' . $query . '%');
                            })
                            ->orWhereHas('subscription', function ($q) use ($query) {
                                $q->where('total', 'like', '%' . $query . '%');
                            })
                            ->orWhereHas('subscription', function ($q) use ($query) {
                                $q->whereHas('customer', function ($q) use ($query) {
                                    $q->where('name', 'like', '%' . $query . '%');
                                });
                            });
                        })
                    ->with('subscription','subscription.customer')->get();
                    
            }
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'total_amount' => $wallet_sum,
                'wallet_history' => $wallets,
                'message' => 'Wallet history fetch successfully'
            ]);

        }catch(\Exception $th){
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }
    }
}
