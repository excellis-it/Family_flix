<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\AffiliateCommission;
use Illuminate\Support\Facades\Session;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


/**
    * @group Payment Capture
    *
    * APIs for Payment Capture
*/

class PaymentController extends Controller
{
    // payment capture
    /**
     * Payment capture Api
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @response {
     * "status": true,
     * "message": "Payment captured successfully",
     * "status_code": 200
     * }
     * @response 401 {
     * "status": false,
     * "message": "Something went wrong",
     * "status_code": 401
     * }
     */ 

    public function paymentCapture(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'emailId' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'house_name' => 'required',
            'detail_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'paymentID' => 'required',
            'plan_name' => 'required',
            'plan_price' => 'required',
            'payment_type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        try{
        $data = $request->all();

        $customer_details_count = CustomerDetails::where('email_address',$data['emailId'])->count();
        if($customer_details_count > 0)
        {
            $customer_details = CustomerDetails::where('email_address',$data['emailId'])->first();
            $customer_details->email_address = $data['emailId'];
            $customer_details->first_name = $data['first_name'];
            $customer_details->last_name = $data['last_name'];
            $customer_details->country = $data['country'];
            $customer_details->house_no_street_name = $data['house_name'];
            $customer_details->apartment = $data['detail_address'];
            $customer_details->town = $data['city'];
            $customer_details->state = $data['state'];
            $customer_details->post_code = $data['post_code'];
            $customer_details->phone = $data['phone'];
            $customer_details->update();
        }else{
            $customer_details = new CustomerDetails();
            $customer_details->email_address = $data['emailId'];
            $customer_details->first_name = $data['first_name'];
            $customer_details->last_name = $data['last_name'];
            $customer_details->country = $data['country'];
            $customer_details->house_no_street_name = $data['house_name'];
            $customer_details->apartment = $data['detail_address'];
            $customer_details->town = $data['city'];
            $customer_details->state = $data['state'];
            $customer_details->post_code = $data['post_code'];
            $customer_details->phone = $data['phone'];
            $customer_details->save();
            
        }
    
        $check_user_exists = User::where('email',$data['emailId'])->count();
        if($check_user_exists > 0)
        {
            $user_get = User::where('email',$data['emailId'])->first();
            $user_id = $user_get->id; 
        }else{
            $user = new User();
            $user->name = $data['first_name'].' '.$data['last_name'];
            $user->email = $data['emailId'];
            $user->password = bcrypt('12345678');
            $user->status = 1;
            $user->save();
            $user->assignRole('CUSTOMER');

            //send welcome email
            $maildata = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 12345678,
            ];
           
           
            $user_id = $user->id;
        }

        $plan = Plan::where('plan_name',$data['plan_name'])->first();

       // for renewal plan 
        if($data['payment_type'] == 'Renewal')
        {
            
            $user_subscription = UserSubscription::where('customer_id', $user_id)
            ->where('plan_id', $plan->id)
            ->where('plan_expiry_date', '>=', date('Y-m-d'))
            ->first();
            if($user_subscription)
            {
                $user_subscription->plan_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($user_subscription->plan_expiry_date)));
                $user_subscription->update(); 
            }
        }else{

            
            $user_subscription = new UserSubscription();
            $user_subscription->customer_details_id = $customer_details->id;
            $user_subscription->customer_id = $user_id;
            if (Session::has('affiliate_id')) {

                //affiliate commission calculation
                $affiliate_id = Session::get('affiliate_id');
                $commission = AffiliateCommission::where('affiliate_id',$affiliate_id)->orderBy('id','desc')->first();
                if ($commission) {
                    $commission_dis = ($data['amount'] / 100) * $commission->percentage;
                } else {
                    $commission_dis = 0;
                }

                $user_subscription->affiliate_id = Session::get('affiliate_id');
                $user_subscription->affiliate_commission = $commission_dis;
            } else {
                
                $user_subscription->affiliate_id = null;
                $user_subscription->affiliate_commission = null;
            }

          

            $user_subscription->payment_type = $data['payment_type'] ?? '';
            $user_subscription->plan_id = $plan->id ?? '';
            $user_subscription->plan_name = $data['plan_name'] ?? '';
            $user_subscription->plan_price = $data['plan_price'] ?? '';
            $user_subscription->coupan_code = $data['coupan_code'] ?? '';
            $user_subscription->coupan_discount_type = $data['coupon_discount_type'] ?? '';
            $user_subscription->coupan_discount = $data['coupon_discount'] ?? '';
            $user_subscription->sub_total = $data['plan_price'] ?? '';
            $user_subscription->total = $data['amount'] ?? '';
            $user_subscription->additional_information = $data['additional_information'] ?? '';
            $today = date('Y-m-d');
            $user_subscription->plan_start_date = $today ?? '';
            $user_subscription->plan_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($today)));
            $user_subscription->save();

        }

        $payment = new Payment();
        $payment->user_subscription_id = $user_subscription->id;
        $payment->transaction_id = $data['paymentID'];
        $payment->payment_type = 'paypal';
        $payment->payment_status = 'success';
        $payment->payment_date = date('y-m-d');
        $payment->payment_amount = $data['amount'];
        $payment->payment_currency = 'USD';
        $payment->save();

       

            return response()->json(['status' => true, 'message' => 'Payment captured successfully', 'status_code' => 200]);
        }catch(\Exception $e){
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'status_code' => 401, 'error' => $e->getMessage()]);
        }
    }

    public function billingAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emailId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }


        try{
            $user_details_count = CustomerDetails::where('email_address',$request->emailId)->count();
            if($user_details_count > 0)
            {
                $user_billing_details = CustomerDetails::where('email_address',$request->emailId)->orderBy('id','desc')->first();
                return response()->json(['status' => true, 'message' => 'Details found successfully', 'status_code' => 200, 'data' => $user_billing_details]);
            }else{
                return response()->json(['status' => false, 'message' => 'Details not found', 'status_code' => 200]);
            }
            
        }catch(\Exception $e){
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'status_code' => 401, 'error' => $e->getMessage()]);
        }
    }
}
