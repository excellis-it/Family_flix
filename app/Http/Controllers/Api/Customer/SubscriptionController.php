<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomerDetails;
use App\Models\AffiliateCommission;
use App\Models\Wallet;
use App\Models\Payment;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserSubscriptionMail;
use App\Mail\AdminSubscriptionMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\UserSubscription;
use Stripe\Stripe;
use App\Models\PaymentDetailMail;
use App\Models\Coupon;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Subscription;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Stripe\Plan;
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
     * Subscriptions create Api
     * @response 200{
     * "status": true,
     * "statusCode": 200,
     * "message": "Subscription created successfully!"
     * }
     * @response 422{
     * "status": false,
     * "statusCode": 422,
     * "error": {
     *    "payment_method_id": [
     *       "The payment method id field is required."
     *  ],
     * "email": [
     *   "The email field is required."
     * ],
     * "amount": [
     *  "The amount field is required."
     * ],
     * "plan_id": [
     * "The plan id field is required."
     * ],
     * "plan_name": [
     * "The plan name field is required."
     * ],
     * "plan_price": [
     * "The plan price field is required."
     * ],
     * "country": [
     * "The country field is required."
     * ],
     * "state": [
     * "The state field is required."
     * ],
     * "city": [
     * "The city field is required."
     * ],
     * "house_name": [
     * "The house name field is required."
     * ],
     * "post_code": [
     * "The post code field is required."
     * ]
     * }
     * }
     */

    public function stripePaymentCreate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'payment_method_id' => 'required',
            'email' => 'required',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'amount' => 'required',
            'plan_id' => 'required',
            'plan_name' => 'required',
            'plan_price' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'house_name' => 'required',
            'post_code' => 'required',
        ]);

        $check_user_exists = User::where('email', $request->email)->first();
        if($check_user_exists) // Check if user exists
        {
            $user_subscription = UserSubscription::where('customer_id', $check_user_exists->id)
                ->where('plan_id', $request->plan_id)
                ->where('plan_expiry_date', '>=', date('Y-m-d'))
                ->first();

            if($user_subscription)
            {
                return response()->json(['status' => false, 'statusCode' => 200, 'error' => 'You already have an active subscription!'], 200);
            }
        }

        if ($validator->fails()) {
            return response()->json(['status' => false, 'statusCode' => 200,  'error' => $validator->errors()->first()], 200);
        }

        // Stripe::setApiKey(env('STRIPE_SUBSCRIPTION_SECRET'));
        $stripe = Helper::stripeCredential();

        if (!empty($stripe->stripe_secret)) {
            \Stripe\Stripe::setApiKey($stripe->stripe_secret);  // Set the secret API key
        } else {
            // Handle missing secret key
            throw new \Exception('Stripe secret key is missing');
        }

        try {
            $data = $request->all();
            $paymentMethodId = $data['payment_method_id'];
            $price_id = '';  // Declare the variable outside the loop
            $plan = Plan::all();  // Retrieve all plans
            $arrayVal = array();

            foreach ($plan as $key => $value) {

                $amount = $value->amount / 100;
                $actual_amount = round($amount, 2);
                $arrayVal[$actual_amount]['plan_id'] = $value->id;
                $arrayVal[$actual_amount]['actual_amount'] = $actual_amount;
            }

            if (strpos($data['plan_price'], '.') === false) {
                $formattedPrice = round($data['plan_price'], 2);
            } else {
                $formattedPrice = $data['plan_price'];
            }

            if (isset($arrayVal[$formattedPrice])) {
                $price_id = $arrayVal[$formattedPrice]['plan_id'];
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Plan not found'
                ]);
            }

            // payment process
            $customer = Customer::all(['email' => $data['email']])->data[0] ?? null;
            if (!$customer) {
                $customer = Customer::create([
                    'email' => $data['email'],
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                ]);
            }

            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            if ($paymentMethod->customer !== $customer->id) {
                $paymentMethod->attach(['customer' => $customer->id]);

                // update card details in customer default payment method
                $customer = Customer::update(
                    $customer->id,
                    ['invoice_settings' => ['default_payment_method' => $paymentMethodId]]
                );
            }

            // $subscription = Subscription::create([
            //     'customer' => $customer->id,
            //     'items' => [[
            //         'price' => $price_id, // Replace with your price ID from Stripe Dashboard
            //     ]],
            //     'default_payment_method' => $paymentMethod,
            //     'expand' => ['latest_invoice.payment_intent'],
            // ]);

            $subscriptionParams = [
                'customer' => $customer->id,
                'items' => [[
                    'price' => $price_id, // Replace with your price ID from Stripe Dashboard
                ]],
                'default_payment_method' => $paymentMethod,
                'expand' => ['latest_invoice.payment_intent'],
            ];

            $coupon_detail = Coupon::where('code', $request->coupan_code)->first();

            if (!empty($coupon_detail)) {
                // Check if the coupon exists in Stripe
                try {
                    $coupon = \Stripe\Coupon::retrieve($coupon_detail->stripe_coupon_id);
                    if ($coupon) {
                        // Add coupon to the subscription parameters
                        $subscriptionParams['coupon'] = $coupon_detail->stripe_coupon_id;
                    }
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Invalid coupon code.'], 400);
                }
            }
            $subscription = \Stripe\Subscription::create($subscriptionParams);


            $check_user_exists = User::where('email', $data['email'])->count();
            if ($check_user_exists > 0) {
                $user_get = User::where('email', $data['email'])->first();
                $user_id = $user_get->id;
            } else {
                $user = new User();
                $user->name = $data['first_name'] . ' ' . $data['last_name'];
                $user->email = $data['email'];
                $user->password = bcrypt('12345678');
                $user->phone = $data['phone'] ?? '';
                $user->status = 1;
                $user->wallet_balance = 0;
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

            //customer details add
            $customer_details_count = CustomerDetails::where('email_address', $data['email'])->count();
            if ($customer_details_count > 0) {
                $customer_details = CustomerDetails::where('email_address', $data['email'])->first();
                $customer_details->email_address = $data['email'];
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
            } else {
                $customer_details = new CustomerDetails();
                $customer_details->email_address = $data['email'];
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

            // add user subscription
            $user_subscription = new UserSubscription();
            $user_subscription->customer_details_id = $customer_details->id ?? null;
            $user_subscription->customer_id = $user_id ?? null;
            if (Session::has('affiliate_id')) {
                //affiliate commission calculation
                $affiliate_id = Session::get('affiliate_id');
                $commission = AffiliateCommission::where('affiliate_id', $affiliate_id)->orderBy('id', 'desc')->first();
                if ($commission) {
                    // $commission_dis = ($data['amount'] / 100) * $commission->percentage;
                    $commission_dis = round(($data['amount'] / 100) * $commission->percentage, 2);
                    $admin_commission = $data['amount'] - $commission_dis;
                } else {
                    $commission_dis = 0;
                    $admin_commission = $data['amount'];
                }

                $user_subscription->affiliate_id = Session::get('affiliate_id') ?? null;
                $user_subscription->affiliate_commission = $commission_dis ?? 0;
            } else {
                $user_subscription->affiliate_id = null;
                $user_subscription->affiliate_commission = 0;
            }

            $user_subscription->stripe_subscription_id = $subscription->id;
            // $user_subscription->payment_type = $data['payment_type'];
            $user_subscription->plan_id = $data['plan_id'] ?? '';
            $user_subscription->plan_name = $data['plan_name'] ?? '';
            $user_subscription->plan_price = $data['plan_price'] ?? '';
            $user_subscription->coupan_code = $data['coupon_code'] ?? '';
            $user_subscription->coupan_discount_type = $data['coupon_discount_type'] ?? '';
            $user_subscription->coupan_discount = $data['coupon_discount'] ?? '';
            $user_subscription->sub_total = $data['plan_price'] ?? '';
            $user_subscription->total = $data['amount'] ?? '';
            $user_subscription->additional_information = $data['additional_information'] ?? '';
            $today = date('Y-m-d');
            $user_subscription->plan_start_date = $today ?? '';
            $user_subscription->plan_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($today)));
            $user_subscription->save();

            // admin wallet add
            $wallet = new Wallet();
            $walletId = Str::random(12);
            $wallet->wallet_id = $walletId;
            $wallet->user_subscription_id = $user_subscription->id;
            $wallet->user_type = 'admin';
            $wallet->balance = $data['amount'] - $user_subscription->affiliate_commission;
            $wallet->date = date('Y-m-d');
            $wallet->save();


            $admin_balance = User::role('ADMIN')->first();
            $admin_wallet_balance = str_replace(',', '', $admin_balance->wallet_balance);
            $balance = $admin_wallet_balance + ($data['amount'] - $user_subscription->affiliate_commission);
            $admin_balance->wallet_balance = round($balance, 2);
            $admin_balance->update();

            //affiliator wallet add
            $wallet = new Wallet();
            $wallet->wallet_id = $walletId;
            $wallet->user_subscription_id = $user_subscription->id ?? null;
            $wallet->user_type = 'affiliator';
            $wallet->user_id = $user_subscription->affiliate_id ?? null;
            $wallet->balance = $user_subscription->affiliate_commission ?? 0;
            $wallet->date = date('Y-m-d');
            $wallet->save();

            $affiliator_balance = User::find($user_subscription->affiliate_id);
            if ($affiliator_balance) {
                $balance_amount = $affiliator_balance->wallet_balance + $user_subscription->affiliate_commission;
                $affiliator_balance->wallet_balance = round($balance_amount, 2);
                $affiliator_balance->update();
            }

            $payment = new Payment();
            $payment->user_subscription_id = $user_subscription->id;
            $payment->transaction_id = $paymentMethodId;
            $payment->payment_type = 'stripe';
            $payment->payment_status = 'success';
            $payment->payment_date = date('y-m-d');
            $payment->payment_amount = $data['amount'];
            $payment->payment_currency = 'USD';
            $payment->save();

            $userSubscriptionMailData = [
                'name' => $user->name,
                'email' => $user->email,
                'plan_name' => $data['plan_name'],
                'plan_price' => $data['plan_price'],
                'plan_start_date' => $today,
                'plan_expiry_date' => date('Y-m-d', strtotime('+30 days', strtotime($today))),
            ];

            $admin_payment_mail = PaymentDetailMail::where('status', 1)->first();
            Mail::to($user->email)->send(new UserSubscriptionMail($userSubscriptionMailData));
            Mail::to($admin_payment_mail->email)->send(new AdminSubscriptionMail($userSubscriptionMailData));

            return response()->json(['status' => true, 'statusCode' => 200, 'message' => 'Subscription created successfully!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()]);
        }
    }


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

     /**
     * Subscriptions Api
     * @authenticated
     * @response 200{
     * "status": true,
     * "statusCode": 200,
     * "data": {
     *  "stripe_key": "pk_test_51
     * "stripe_secret": "sk_test_51"
     * }
     * }
     * @response 200{
     *  "status": false,
     * "statusCode": 200,
     * "error": "Stripe credential not found!"
     * }
     * @response 401{
     * "status": false,
     * "statusCode": 401,
     * "error": "Unauthorised"
     * }
     */

    public function stripePaymentCredential()
    {
        try{
            $stripe = Helper::stripeCredential();
            if($stripe)
            {
                return response()->json(['status' => true, 'statusCode' => 200, 'data' => $stripe], 200);
            }else{
                return response()->json(['status' => false, 'statusCode' => 200, 'error' => 'Stripe credential not found!'], 200);
            }

        }catch (\Throwable $th) {
            return response()->json(['status' => false, 'statusCode' => 401, 'error' => $th->getMessage()], 401);
        }

    }


}
