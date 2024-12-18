<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerDetails;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Payment;

class PaymentController extends Controller
{
    //
    public function customerPayment(Request $request)
    {
        //validation
        $request->validate([
            'plan_id' => 'required',
        ]);


        $data = $request->all();
        $customer_details =  CustomerDetails::where('id', $data['customer_id'])->orderBy('id','desc')->first() ?? '';
        $plan_details = Plan::where('id',$data['plan_id'])->first();
        $user_details = User::where('id',$data['customer_id'])->first();

        if($customer_details){
            $customer_details_add = new CustomerDetails();
            $customer_details_add->email_address = $customer_details->email_address;
            $customer_details_add->first_name = $customer_details->first_name;
            $customer_details_add->last_name = $customer_details->last_name;
            $customer_details_add->country = $customer_details->country;
            $customer_details_add->house_no_street_name = $customer_details->house_no_street_name;
            $customer_details_add->apartment = $customer_details->apartment;
            $customer_details_add->town = $customer_details->town;
            $customer_details_add->state =  $customer_details->state;
            $customer_details_add->post_code = $customer_details->post_code;
            $customer_details_add->phone = $customer_details->phone;
            $customer_details_add->save();
        }else{
            $customer_details_add = new CustomerDetails();
            $customer_details_add->email_address = $user_details->email;
            $customer_details_add->first_name = $user_details->name;
            $customer_details_add->last_name = '';
            $customer_details_add->country = '';
            $customer_details_add->house_no_street_name = '';
            $customer_details_add->apartment = '';
            $customer_details_add->town = '';
            $customer_details_add->state = '';
            $customer_details_add->post_code = '';
            $customer_details_add->phone = $user_details->phone;
            $customer_details_add->save();
        }

        // $check_user_exists = User::where('email',$data['emailId'])->count();
        // if($check_user_exists > 0)
        // {
        //     $user_get = User::where('email',$data['emailId'])->first();
        //     $user_id = $user_get->id;
        // }else{
        //     $user = new User();
        //     $user->name = $data['first_name'].' '.$data['last_name'];
        //     $user->email = $data['emailId'];
        //     $user->password = bcrypt('12345678');
        //     $user->status = 1;
        //     $user->save();
        //     $user->assignRole('CUSTOMER');

        //     //send welcome email
        //     $maildata = [
        //         'name' => $user->name,
        //         'email' => $user->email,
        //         'password' => 12345678,
        //     ];
        //     Mail::to($user->email)->send(new WelcomeMail($maildata));

        //     $user_id = $user->id;
        // }




        //user subscription
        $user_subscription = new UserSubscription();
        $user_subscription->customer_details_id = $customer_details_add->id;
        $user_subscription->customer_id = $data['customer_id'];
        $user_subscription->payment_type = 'paypal';
        $user_subscription->plan_name = $plan_details->plan_name;
        $user_subscription->plan_price = $plan_details->plan_offer_price;
        $user_subscription->sub_total = $plan_details->plan_offer_price;
        $user_subscription->total = $plan_details->plan_offer_price;
        $user_subscription->additional_information = $data['message'];
        $today = date('Y-m-d');
        $user_subscription->plan_start_date = $today;
        $user_subscription->plan_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($today)));
        $user_subscription->save();

        $payment = new Payment();
        $payment->user_subscription_id = $user_subscription->id;
        if(isset($data['transaction_id'])){
            $payment->transaction_id = $data['transaction_id'];
        }else{
            $payment->transaction_id = '';
        }
        $payment->payment_type = 'paypal';
        $payment->payment_status = 'success';
        $payment->payment_date = date('y-m-d');
        $payment->payment_amount = $plan_details->plan_offer_price;
        $payment->payment_currency = 'USD';
        $payment->save();

       return redirect()->back()->with('message', 'Payment done successfully.');
    }
}
