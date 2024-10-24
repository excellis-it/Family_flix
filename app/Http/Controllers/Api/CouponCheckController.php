<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

/**
    * @group Coupon Check
    *
    * APIs for Coupon Check
*/

class CouponCheckController extends Controller
{
    /**
     * Coupon check Api
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @response {
     * "status": true,
     * "message": "Coupon code applied successfully",
     * "discount": 100,
     * "coupon_discount": 100,
     * "coupon_discount_type": "fixed",
     * "status_code": 200
     * }
     * @response 200 {
     * "status": false,
     * "message": "Invalid coupon code",
     * "status_code": 200
     * }
     * @response 200 {
     * "status": false,
     * "message": "Coupon code is not valid for you",
     * "status_code": 200
     * },
     * 
    
     */
    public function checkCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|exists:coupons,code',
            'plan_id' => 'required|exists:plans,id',
            'plan_price' => 'required',
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        try{
            $check_user = CustomerDetails::where('email_address', $request->email)->orWhere('phone', $request->phone)->first();
            $coupon = Coupon::where('code', $request->coupon_code)->where('plan_id',$request->plan_id)->first();
            if(!$coupon)
            {
                return response()->json(['status' => false, 'message' => 'Invalid coupon code', 'status_code' => 200]);
            }
            $check_coupon_user_type = $coupon->user_type;
            if(!$check_user && $check_coupon_user_type == 'new_user')
            {
                //calculate discount
                if($coupon->coupon_type == 'percentage')
                {
                    $discount_percent_amt = ($request->plan_price / 100) * $coupon->value;
                    $discount = number_format($discount_percent_amt, 2, '.', '');
                }
                else
                {
                    $discount = $coupon->value;
                }

                $dis_amount = $request->plan_price - $discount;
                $discount_amount = number_format($dis_amount, 2, '.', '');

                if($discount_amount)
                {
                    return response()->json(['status' => true ,'message' => 'Coupon code applied successfully', 'discount' => $discount_amount, 'coupon_discount' => $discount, 'coupon_discount_type' => $coupon->coupon_type , 'status_code' => 200]);
                }


            } elseif($check_user && $check_coupon_user_type == 'existing_user') {

                //calculate discount
                if($coupon->coupon_type == 'percentage')
                {

                    $discount = round(($request->plan_price  / 100) * $coupon->value);
                }
                else
                {
                    $discount = $coupon->value;
                }

                $discount_amount = round($request->plan_price - $discount);

                if($discount_amount)
                {
                    return response()->json(['status' => true, 'message' => 'Coupon code applied successfully', 'discount' => $discount_amount, 'coupon_discount' => $discount, 'coupon_discount_type' => $coupon->coupon_type , 'status_code' => 200]);
                }

            }else{
                return response()->json(['status' => false, 'message' => 'Coupon code is not valid for you', 'status_code' => 200]);
            }
        }catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'status_code' => 401, 'error' => $e->getMessage()]);
        }
    }


    /** 
    * Coupon list Api
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    * @response {
    * "status": true,
    * "message": "Coupon list fetch successfully",
    * "coupon_list": [
    * {
    * "code": "TEST123",
    * "id": 1
    * },
    * {
    * "code": "TEST456",
    * "id": 2
    * }
    * ],
    * "status_code": 200
    * }
    */

    public function listCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'email' => 'required_without:phone|email',
            'phone' => 'required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        try{
            $check_user = CustomerDetails::where('email_address', $request->email)->orWhere('phone', $request->phone)->count();
            if($check_user > 0)
            {
                $coupon = Coupon::where('plan_id',$request->plan_id)->where('user_type','existing_user')->select('code','id')->get();
                if($coupon)
                {
                    return response()->json(['status' => true, 'message' => 'Coupon list fetch successfully', 'coupon_list' => $coupon, 'status_code' => 200]);
                }
            }
            else
            {
                $coupon = Coupon::where('plan_id',$request->plan_id)->where('user_type','new_user')->select('code','id')->get();
                if($coupon)
                {
                    return response()->json(['status' => true, 'message' => 'Coupon list fetch successfully', 'coupon_list' => $coupon, 'status_code' => 200]);
                }
            }
        }
        catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'status_code' => 401, 'error' => $e->getMessage()]);
        }


    }
}
