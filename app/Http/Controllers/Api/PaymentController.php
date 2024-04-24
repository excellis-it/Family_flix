<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Payment;
use App\Models\AffiliateCommission;
use Illuminate\Support\Facades\Session;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

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
        // valiadtion 
        $request->validate([
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
        ]);

        try{
            $data = $request->all();
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
                Mail::to($user->email)->send(new WelcomeMail($maildata));

                $user_id = $user->id;
            }


            //user subscription
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

            $user_subscription->payment_type = 'paypal';
            $user_subscription->plan_name = $data['plan_name'];
            $user_subscription->plan_price = $data['plan_price'];
            $user_subscription->coupan_code = $data['coupan_code'];
            $user_subscription->coupan_discount = $data['coupon_discount'];
            $user_subscription->sub_total = $data['plan_price'];
            $user_subscription->total = $data['amount'];
            $user_subscription->additional_information = $data['additional_information'];
            $today = date('Y-m-d');
            $user_subscription->plan_start_date = $today;
            $user_subscription->plan_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($today)));
            $user_subscription->save();

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
}