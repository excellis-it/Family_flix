<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use App\Models\User;
use Stripe\PaymentMethod;
use Stripe\Subscription;
use Stripe\Price;
use Stripe\Plan;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Stripe\StripeClient;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Session;
use App\Models\UserSubscription;
use App\Models\AffiliateCommission;
use App\Models\Affiliate;
use App\Models\Wallet;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\Mail;


class SubscriptionController extends Controller
{
    //
    public function createSubscription(Request $request)
    {
       // need Helper function stripeCredential 
       $stripe = Helper::stripeCredential(); 

       if (!empty($stripe->stripe_secret)) {
           \Stripe\Stripe::setApiKey($stripe->stripe_secret);  // Set the secret API key
       } else {
           // Handle missing secret key
           throw new \Exception('Stripe secret key is missing');
       }
       
        // Stripe::setApiKey(env('STRIPE_SUBSCRIPTION_SECRET'));

        $data = $request->all();
        $paymentMethodId = $data['payment_method_id'];
        $price_id = '';  // Declare the variable outside the loop
        $plan = Plan::all();  // Retrieve all plans
        $arrayVal = array();

        foreach ($plan as $key => $value) {

            $amount = $value->amount / 100;
            $actual_amount = number_format($amount, 2);
            $arrayVal[$actual_amount]['plan_id'] = $value->id;
            $arrayVal[$actual_amount]['actual_amount'] = $actual_amount;
        }

        if (strpos($data['plan_price'], '.') === false) {
            $formattedPrice = number_format($data['plan_price'], 2);
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

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'items' => [[
                'price' => $price_id, // Replace with your price ID from Stripe Dashboard
            ]],
            'default_payment_method' => $paymentMethod,
            'expand' => ['latest_invoice.payment_intent'],
        ]);

        // check user exists or not
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
            // Mail::to($user->email)->send(new WelcomeMail($maildata));
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
                $commission_dis = ($data['amount'] / 100) * $commission->percentage;
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
        $admin_balance->wallet_balance = $admin_balance->wallet_balance + ($data['amount'] - $user_subscription->affiliate_commission);
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
            $affiliator_balance->wallet_balance = $affiliator_balance->wallet_balance + $user_subscription->affiliate_commission;
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

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully'
        ]);

    }

    public function successSubscription()
    {
        return view('frontend.pages.thankyou');
    }

    public function failedSubscription()
    {
        return view('frontend.pages.payment-failed');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);

            if ($event->type == 'invoice.payment_succeeded') {
                // Handle successful payment event
                $invoice = $event->data->object;
                // Update your database, send email, etc.
            }
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
            exit();
        }

        http_response_code(200);
    }
}
