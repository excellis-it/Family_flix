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
// use Stripe\Plan;
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
use App\Models\Coupon;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\CustomerDetails;
use App\Mail\UserSubscriptionMail;
use App\Mail\AdminSubscriptionMail;
use Illuminate\Support\Facades\DB;
use App\Models\PaymentDetailMail;
use App\Models\Plan as ModelsPlan;
use Braintree\Gateway;
use Braintree\Transaction;
use Braintree\Plan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{

    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }


    public function createSubscriptionBraintree(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'house_name' => 'required|string|max:255',
            'detail_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'phone' => 'required|numeric',
            'payment_method_nonce' => 'required|string',
            'plan_id' => 'required|integer',
        ];

        // If the user is authenticated, skip password validation
        if (!Auth::check()) {
            $rules['password'] = 'required|min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $data = $request->all();

            $user = User::where('email', $request->email)->first();
            if (!Auth::check()) {
                if ($user) {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $user = User::where('email', $request->email)->first();
                        if ($user->hasRole('CUSTOMER') && $user->status == 1) {
                            $user_id = $user->id;
                        } else {
                            Auth::logout();
                            return response()->json([
                                'success' => false,
                                'error' => 'Your account is deactivated!',
                            ]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'error' => 'Email or password is invalid!',
                        ]);
                    }
                } else {
                    $user = new User();
                    $user->name = $data['first_name'] . ' ' . $data['last_name'];
                    $user->email = $data['email'];
                    $password = $data['password'];
                    $user->password = bcrypt($password);
                    $user->phone = $data['phone'] ?? '';
                    $user->status = 1;
                    $user->wallet_balance = 0;
                    $user->save();
                    $user->assignRole('CUSTOMER');

                    // send welcome email
                    $maildata = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $password,
                    ];
                    Mail::to($user->email)->send(new WelcomeMail($maildata));
                    $user_id = $user->id;
                }
            } else {
                $user_id = auth()->id();
            }

            // Fetch plan details
            $plan = ModelsPlan::find($data['plan_id']);
            if (!$plan) {
                return response()->json([
                    'success' => false,
                    'error' => 'Plan not found',
                ]);
            }

            // Check for coupon
            $coupon_detail = Coupon::where('code', $request->coupon_code)->first();
            $discount = 0;
            if (!empty($coupon_detail)) {
                // Apply coupon discount
                $discount = $coupon_detail->discount;
            }


            $customer = $this->gateway->customer()->create([
                'firstName' =>  $data['first_name'],
                'lastName' =>  $data['last_name'],
                'email' => $data['email'],
                'paymentMethodNonce' => $data['payment_method_nonce'],
            ]);

            // throw new \Exception($customer);
            // dd($customer);
            if ($customer->success) {
                $customerId = $customer->customer->id;

                // Create the subscription
                $subscription = $this->gateway->subscription()->create([
                    'paymentMethodToken' => $customer->customer->paymentMethods[0]->token,
                    'planId' => $plan->braintree_plan_id, // Plan ID from Braintree dashboard
                    'price' => $data['plan_price'] - $discount, // Apply discount if any
                ]);

                if ($subscription->success) {
                    // Save customer details
                    $customer_details = CustomerDetails::updateOrCreate(
                        ['email_address' => $data['email']],
                        [
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'country' => $data['country'],
                            'house_no_street_name' => $data['house_name'],
                            'apartment' => $data['detail_address'],
                            'town' => $data['city'],
                            'state' => $data['state'],
                            'post_code' => $data['post_code'],
                            'phone' => $data['phone'],
                        ]
                    );

                    // Add subscription record
                    $user_subscription = new UserSubscription();
                    $user_subscription->customer_details_id = $customer_details->id;
                    $user_subscription->customer_id = $user_id;
                    $user_subscription->braintree_subscription_id = $subscription->subscription->id;

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
                    $user_subscription->subscription_status = 1;
                    $user_subscription->save();

                    // Wallet management (admin and affiliate)
                    // $wallet = new Wallet();
                    // $wallet->wallet_id = Str::random(12);
                    // $wallet->user_subscription_id = $user_subscription->id;
                    // $wallet->user_type = 'admin';
                    // $wallet->balance = $user_subscription->total;
                    // $wallet->save();

                    // Update admin balance
                    $admin_balance = User::role('ADMIN')->first();
                    $admin_wallet_balance = $admin_balance->wallet_balance;
                    $admin_balance->wallet_balance = $admin_wallet_balance + $user_subscription->total;
                    $admin_balance->save();

                    // Affiliate commission
                    if (Session::has('affiliate_id')) {
                        $affiliate_id = Session::get('affiliate_id');
                        $commission = AffiliateCommission::where('affiliate_id', $affiliate_id)->latest()->first();
                        if ($commission) {
                            $commission_dis = round(($user_subscription->total) * ($commission->percentage / 100), 2);
                            $user_subscription->affiliate_commission = $commission_dis;
                            $user_subscription->affiliate_id = Session::get('affiliate_id') ?? null;
                            $user_subscription->affiliate_commission = $commission_dis ?? 0;
                        }
                    }

                    $user_subscription->save();

                    if (Session::has('affiliate_id')) {

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
                            $affi_balance = $affiliator_balance->wallet_balance + $user_subscription->affiliate_commission;
                            $affiliator_balance->wallet_balance = round($affi_balance, 2);
                            $affiliator_balance->update();
                        }
                    }

                    $payment = new Payment();
                    $payment->user_subscription_id = $user_subscription->id;
                    $payment->transaction_id = $subscription->subscription->id;
                    $payment->payment_type = 'Braintree';
                    $payment->payment_status = 'success';
                    $payment->payment_date = date('y-m-d');
                    $payment->payment_amount = $data['amount'];
                    $payment->payment_currency = 'USD';
                    $payment->save();



                    // Send emails
                    $userSubscriptionMailData = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'plan_name' => $plan->name,
                        'plan_price' => $plan->price,
                        'plan_start_date' => now(),
                        'plan_expiry_date' => now()->addMonth(),
                    ];
                    Session::put('user_id', $user_id);
                    Mail::to($user->email)->send(new UserSubscriptionMail($userSubscriptionMailData));
                    // Optionally, notify admin
                    $admin_subscription_mail = PaymentDetailMail::where('status', 1)->first();
                    Mail::to($admin_subscription_mail->email)->send(new AdminSubscriptionMail($userSubscriptionMailData));

                    return response()->json([
                        'success' => true,
                        'message' => 'Subscription created successfully',
                    ]);
                } else {
                    throw new \Exception('Braintree subscription creation failed');
                }
            } else {
                throw new \Exception('Braintree customer creation failed');
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ]);
        }
    }






    //
    public function createSubscription(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'house_name' => 'required|string|max:255',
            'detail_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'post_code' => 'required|string|max:20',
            'phone' => 'required|numeric',
            'payment_method_id' => 'required|string',
            'plan_id' => 'required|integer',
        ];

        // If the user is authenticated, skip password validation
        if (!Auth::check()) {
            $rules['password'] = 'required|min:6';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $data = $request->all();

            $user = User::where('email', $request->email)->first();
            if (!Auth::check()) {
                if ($user) {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $user = User::where('email', $request->email)->first();
                        if ($user->hasRole('CUSTOMER') && $user->status == 1) {
                            // Auth::login();
                            $user_id = $user->id;
                        } else {
                            Auth::logout();
                            return response()->json([
                                'success' => false,
                                'error' => 'Your account is deactivate!',
                            ]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'error' => 'Email id & password was invalid!',
                        ]);
                    }
                } else {
                    $user = new User();
                    $user->name = $data['first_name'] . ' ' . $data['last_name'];
                    $user->email = $data['email'];
                    $password = $data['password'];
                    $user->password = bcrypt($password);
                    $user->phone = $data['phone'] ?? '';
                    $user->status = 1;
                    $user->wallet_balance = 0;
                    $user->save();
                    $user->assignRole('CUSTOMER');

                    //send welcome email
                    $maildata = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $password,
                    ];
                    Mail::to($user->email)->send(new WelcomeMail($maildata));
                    $user_id = $user->id;
                }
            } else {
                $user_id = auth()->id();
            }


            // need Helper function stripeCredential
            $stripe = Helper::stripeCredential();

            if (!empty($stripe->stripe_secret)) {
                \Stripe\Stripe::setApiKey($stripe->stripe_secret);  // Set the secret API key
            } else {
                // Handle missing secret key
                throw new \Exception('Stripe secret key is missing');
            }

            // Stripe::setApiKey(env('STRIPE_SUBSCRIPTION_SECRET'));


            $paymentMethodId = $data['payment_method_id'];
            $price_id = '';  // Declare the variable outside the loop
            $plan = Plan::all(); // Retrieve all plans
            $arrayVal = array();

            // dd($plan);
            foreach ($plan as $key => $value) {

                // if($value->active == 1){
                $amount = $value->amount / 100;
                $actual_amount = round($amount, 2);
                $arrayVal[$actual_amount]['plan_id'] = $value->id;
                $arrayVal[$actual_amount]['actual_amount'] = $actual_amount;
                // }
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
                    'success' => false,
                    'error' => 'Plan not found'
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

            $subscriptionParams = [
                'customer' => $customer->id,
                'items' => [[
                    'price' => $price_id, // Replace with your price ID from Stripe Dashboard
                ]],
                'default_payment_method' => $paymentMethod,
                'expand' => ['latest_invoice.payment_intent'],
            ];

            $coupon_detail = Coupon::where('code', $request->coupon_code)->first();

            if (!empty($coupon_detail)) {
                // Check if the coupon exists in Stripe
                try {
                    $coupon = \Stripe\Coupon::retrieve($coupon_detail->stripe_coupon_id);
                    if ($coupon) {
                        // Add coupon to the subscription parameters
                        $subscriptionParams['coupon'] = $coupon_detail->stripe_coupon_id;
                    }
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Invalid coupon code.', 'succuss' => false], 400);
                }
            }


            $subscription = \Stripe\Subscription::create($subscriptionParams);

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
            $user_subscription->subscription_status = 1;
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
                $affi_balance = $affiliator_balance->wallet_balance + $user_subscription->affiliate_commission;
                $affiliator_balance->wallet_balance = round($affi_balance, 2);
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
            Session::put('user_id', $user_id);
            $user_detail = User::find($user_id);
            // user subscription mail
            $userSubscriptionMailData = [
                'name' => $user_detail->name,
                'email' => $user_detail->email,
                'plan_name' => $data['plan_name'],
                'plan_price' => $data['plan_price'],
                'plan_start_date' => $today,
                'plan_expiry_date' => date('Y-m-d', strtotime('+30 days', strtotime($today))),
            ];


            $admin_payment_mail = PaymentDetailMail::where('status', 1)->first();
            Mail::to($user_detail->email)->send(new UserSubscriptionMail($userSubscriptionMailData));
            Mail::to($admin_payment_mail->email)->send(new AdminSubscriptionMail($userSubscriptionMailData));

            return response()->json([
                'success' => true,
                'message' => 'Subscription created successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function successSubscription()
    {
        // get session user id
        if (Auth::user()) {
            return redirect()->route('customer.myFamily-cinema');
        } else {
            $user_id = Session::get('user_id');
            $user = User::find($user_id);
            Auth::login($user);

            return redirect()->route('customer.myFamily-cinema');
        }



        // return view('frontend.pages.thankyou');
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

    public function couponList(Request $request)
    {

        $check_user = CustomerDetails::where('email_address', $request->emailId)->orWhere('phone', $request->plan_id)->count();
        if ($check_user > 0) {
            $coupon = Coupon::where('plan_id', $request->plan_id)->where('user_type', 'existing_user')->select('code', 'id')->get();
            if ($coupon) {
                return response()->json(['status' => true, 'message' => 'Coupon list fetch successfully', 'coupon_list' => $coupon, 'status_code' => 200]);
            }
        } else {
            $coupon = Coupon::where('plan_id', $request->plan_id)->where('user_type', 'new_user')->select('code', 'id')->get();
            if ($coupon) {
                return response()->json(['status' => true, 'message' => 'Coupon list fetch successfully', 'coupon_list' => $coupon, 'status_code' => 200]);
            }
        }
    }
}
