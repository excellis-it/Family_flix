<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AdminSubscriptionMail;
use App\Mail\UserSubscriptionMail;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\UserSubscription;
use App\Models\CustomerDetails;
use App\Models\AffiliateCommission;
use App\Models\Payment;
use App\Models\User;
use App\Models\StripeCredential;
use App\Models\Wallet;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\PaymentDetailMail;
use App\Models\PaypalCredential;
use App\Models\UserSubscriptionRecurring;
use App\Traits\PayPalTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Braintree\Gateway;
class BraintreeController extends Controller
{
    use PayPalTrait;
    //
    // private $gateway;

    // public function __construct()
    // {
    //     $this->gateway = Omnipay::create('PayPal_Rest');
    //     $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
    //     $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
    //     $this->gateway->setTestMode(true); //set it to 'false' when go live
    // }

    protected $gateway;

    public function __construct()
    {
         $braintree = StripeCredential::where('status', 1)->first();
         $this->gateway = new Gateway([
            'environment' => $braintree->credential_name,
            'merchantId' => $braintree->merchant_id,
            'publicKey' => $braintree->stripe_key,
            'privateKey' => $braintree->stripe_secret,
        ]);
        // $this->gateway = new Gateway([
        //     'environment' => env('BRAINTREE_ENV'),
        //     'merchantId' => env('BRAINTREE_MERCHANT_ID'),
        //     'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
        //     'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        // ]);
    }



    public function createPayments($id)
    {

        $id = decrypt($id);
        $plan = Plan::find($id);
        $stripe_detail = StripeCredential::where('status', 1)->first();
        if (Auth::check()) {
            $user = Auth::user();
            $customer_details = CustomerDetails::where('email_address', $user->email)->first() ?? '';
            $plan_exists = UserSubscription::where('customer_id', Auth::user()->id)->where('plan_name', $plan->plan_name)->where('plan_expiry_date', '>=', date('Y-m-d'))->count() ?? 0;
        } else {
            $customer_details = '';
            $plan_exists = 0;
        }

        $braintreeToken = $this->gateway->clientToken()->generate();


        $faq_qstn_ansrs = Faq::where('type', 'payment')->orderBy('id', 'asc')->get();
        return view('frontend.pages.checkout', compact('plan', 'faq_qstn_ansrs', 'customer_details', 'plan_exists', 'stripe_detail', 'braintreeToken'));
    }



    public function paymentTypeCheck(Request $request)
    {

        //check the request plan is already subscribed by the user and its not expired
        $check_user_subscription = UserSubscription::where('customer_id', Auth::user()->id)
            ->where('plan_expiry_date', '>=', date('Y-m-d'))
            ->count();

        if ($check_user_subscription > 0) {
            $check_user_same_plan =  UserSubscription::where('customer_id', Auth::user()->id)
                ->where('plan_name', $request->plan_name)
                ->where('plan_expiry_date', '>=', date('Y-m-d'))
                ->count();
            if ($check_user_same_plan > 0) {
                return response()->json(['status' => 'success', 'same_plan' => true, 'message' => 'You can proceed with the payment']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'you have already subscribed a plan']);
            }

            // return response()->json(['status' => 'error', 'message' => 'You have already subscribed this plan']);
        } else {
            return response()->json(['status' => 'success',  'message' => 'You can proceed with the payment']);
        }
    }


    public function processPayments(Request $request)
    {
        $data = $request->all();
        if ($request->all()) {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->amount,
                    'currency' => 'USD',
                    'returnUrl' => route('success-payment'),
                    'cancelUrl' => route('cancel-payments'),
                ))->send();

                if ($response->isRedirect()) {
                    session()->put('data', $data);
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function checkPaymentsEmail(Request $request)
    {
        $check_email_exists = User::where('email', $request->emailId)->count();

        if ($check_email_exists > 0) {
            return response()->json(['status' => 'error', 'message' => 'Email already exists', 'email' => $request->emailId]);
        } else {
            return response()->json(['status' => 'success', 'message' => 'Email is not available', 'email' => $request->emailId]);
        }
    }

    public function successPayment(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            $data = session()->get('data');
            // create a random unique order number
            if ($response->isSuccessful()) {
                //customer details
                $customer_details = new CustomerDetails();
                $customer_details->email_address = $data['email_address'];
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

                //user subscription
                $user_subscription = new UserSubscription();
                $user_subscription->customer_details_id = $customer_details->id;
                $user_subscription->customer_id = Auth::user()->id;
                if (Session::has('affiliate_id')) {

                    //affiliate commission calculation
                    $affiliate_id = Session::get('affiliate_id');
                    $commission = AffiliateCommission::where('affiliate_id', $affiliate_id)->orderBy('id', 'desc')->first();
                    $commission_dis = ($data['amount'] / 100) * $commission->percentage;
                    $after_commission_dis = $data['amount'] - $commission_dis;

                    $user_subscription->affiliate_id = Session::get('affiliate_id');
                    $user_subscription->affiliate_commission = $commission_dis;
                } else {
                    $user_subscription->affiliate_id = null;
                    $user_subscription->affiliate_commission = 0;
                }

                $user_subscription->payment_type = 'paypal';
                $user_subscription->plan_id = $data['plan_id'];
                $user_subscription->plan_name = $data['plan_name'];
                $user_subscription->plan_price = $data['plan_price'];
                $user_subscription->coupan_code = $data['coupan_code'];
                $user_subscription->coupan_discount = $data['coupon_discount'];
                $user_subscription->sub_total = $data['plan_price'];
                $user_subscription->total = $data['amount'];
                $user_subscription->additional_information = $data['additional_information'];
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


                return redirect()->route('payment.successful')->with('message', 'payment successful');
                // return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function cancelPayments(Request $request)
    {
        return redirect()->route('home')->with('error', 'Something went wrong');
    }

    public function couponCheck(Request $request)
    {

        $check_user = CustomerDetails::where('email_address', $request->emailId)->orWhere('phone', $request->phone)->first();
        $coupon = Coupon::where('code', $request->coupon_code)->where('plan_id', $request->plan_id)->first();
        if (!$coupon) {

            return response()->json(['status' => 'error', 'message' => 'Invalid coupon code']);
        }
        $check_coupon_user_type = $coupon->user_type;
        if (!$check_user && $check_coupon_user_type == 'new_user') {
            //calculate discount
            if ($coupon->coupon_type == 'percentage') {
                $dis_amount = ($request->plan_price / 100) * $coupon->value;
                $discount = round($dis_amount, 2);
            } else {
                $discount = $coupon->value;
            }

            $dis_amnt = $request->plan_price - $discount;
            $discount_amount = round($dis_amnt, 2);

            if ($discount_amount) {
                return response()->json(['status' => 'success', 'message' => 'Coupon code applied successfully', 'discount' => $discount_amount, 'coupon_discount' => $discount, 'coupon_discount_type' => $coupon->coupon_type,]);
            }
        } elseif ($check_user && $check_coupon_user_type == 'existing_user') {

            //calculate discount
            if ($coupon->coupon_type == 'percentage') {
                $dis_amount = ($request->plan_price  / 100) * $coupon->value;
                $discount = round($dis_amount, 2);
            } else {

                $discount = $coupon->value;
            }
            $dis_amnt = $request->plan_price - $discount;
            $discount_amount = round($dis_amnt, 2);

            if ($discount_amount) {
                return response()->json(['status' => 'success', 'message' => 'Coupon code applied successfully', 'discount' => $discount_amount, 'coupon_discount' => $discount, 'coupon_discount_type' => $coupon->coupon_type,]);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Coupon code is not valid for you']);
        }
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.thankyou');
    }


    public function paymentsValidate(Request $request)
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
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Validate successful.'
            ]);
        }

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
    }

    public function paymentcapture(Request $request)
    {

        $data = $request->all();

        if (auth()->check()) {
            $user = auth()->user();
        } else {
            $user = User::where('email', $request->email)->first();
        }
        $user_id = $user->id;

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



        $user_subscription = new UserSubscription();
        $user_subscription->customer_details_id = $customer_details->id;
        $user_subscription->customer_id = $user_id;
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

            $user_subscription->affiliate_id = Session::get('affiliate_id');
            $user_subscription->affiliate_commission = $commission_dis;
        } else {
            $user_subscription->affiliate_id = null;
            $user_subscription->affiliate_commission = 0;
        }

        // $user_subscription->payment_type = $data['payment_type'];
        $user_subscription->plan_id = $data['plan_id'];
        $user_subscription->plan_name = $data['plan_name'];
        $user_subscription->plan_price = $data['plan_price'];
        $user_subscription->coupan_code = $data['coupan_code'] ?? null;
        $user_subscription->coupan_discount_type = $data['coupon_discount_type'] ?? null;
        $user_subscription->coupan_discount = $data['coupon_discount'] ?? null;
        $user_subscription->sub_total = $data['plan_price'];
        $user_subscription->total = $data['amount'];
        $user_subscription->additional_information = $data['additional_information'];
        $today = date('Y-m-d');
        $user_subscription->plan_start_date = $today;
        $user_subscription->plan_expiry_date = date('Y-m-d', strtotime('+30 days', strtotime($today)));
        $user_subscription->save();

        // admin wallet
        $wallet = new Wallet();
        $walletId = Str::random(12);
        // $unique_id = substr(uniqid(rand(10, 99), true), -8, 8);
        $wallet->wallet_id = $walletId;
        $wallet->user_subscription_id = $user_subscription->id;
        $wallet->user_type = 'admin';
        $wallet->balance = round(($data['amount'] - $user_subscription->affiliate_commission), 2);
        $wallet->date = date('Y-m-d');
        $wallet->save();

        $admin_balance = User::role('ADMIN')->first();
        // dd($admin_balance->wallet_balance, $user_subscription->affiliate_commission, $data['amount']);
        $wallet_balance = round(($admin_balance->wallet_balance + ($data['amount'] - $user_subscription->affiliate_commission)), 2);
        $admin_balance->wallet_balance = $wallet_balance;
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
            $affiliator_balance->wallet_balance = round(($affiliator_balance->wallet_balance + $user_subscription->affiliate_commission), 2);
            $affiliator_balance->update();
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
        session()->put('user_subscription_id', $user_subscription->id);
        session()->put('data', $data);

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

        return response()->json(['success' => true, 'message' => 'payment successful']);
    }


    public function paypalSuccessPayment($paymentId = null, $PayerID = null)
    {
        $user_subscription_id = session()->get('user_subscription_id');
        $user_subscription = UserSubscription::find($user_subscription_id);
        $data = session()->get('data');
        $plan = Plan::find($user_subscription['plan_id']);


        $user = User::where('email', $data['email'])->first();
        Auth::login($user);

        $paymentId = $data['paymentID'];
        $reccuring = [
            "plan_id" => $plan->paypal_plan_id,
            "start_time" => Carbon::now()->addDays(30)->format('Y-m-d\TH:i:s\Z'),
            "shipping_amount" => [
                "currency_code" => "USD",
                "value" => "0.00"
            ],
            "subscriber" => [
                "name" => [
                    "given_name" => $data['first_name'],
                    "surname" => $data['last_name']
                ],
                "email_address" => $data['email'],
                "shipping_address" => [
                    "name" => [
                        "full_name" => $data['first_name'] . ' ' . $data['last_name']
                    ],
                    "address" => [
                        "address_line_1" => $data['house_name'],
                        "address_line_2" => $data['detail_address'],
                        "admin_area_2" => $data['city'],
                        "admin_area_1" => $data['state'],
                        "postal_code" => $data['post_code'],
                        "country_code" => $data['country']
                    ]
                ]
            ],
            "application_context" => [
                "brand_name" => "The Family Flix",
                "locale" => "en-US",
                "shipping_preference" => "SET_PROVIDED_ADDRESS",
                "user_action" => "SUBSCRIBE_NOW",
                "payment_method" => [
                    "payer_selected" => "PAYPAL",
                    "payee_preferred" => "IMMEDIATE_PAYMENT_REQUIRED"
                ],
                "return_url" => route('paypal.success.payment'),
                "cancel_url" => route('paypal.pay.failed')
            ]
        ];

        $response = $this->subscribeUser($reccuring);
        // dd($response);
        if (isset($response) && isset($response['id'])) {
            $user_subscription->paypal_subscription_id = $response['id'];
            $user_subscription->update();
            $user_subscription_reccuring = new UserSubscriptionRecurring();
            $user_subscription_reccuring->user_id = $user_subscription->customer_id;
            $user_subscription_reccuring->user_subscription_id = $user_subscription->id;
            $user_subscription_reccuring->paypal_subscription_id = $response['id'];
            $user_subscription_reccuring->status = 'PENDING';
            $user_subscription_reccuring->save();

            session()->put('user_subscription_reccuring_id', $user_subscription_reccuring->id);

            session()->forget('data');
            session()->forget('user_subscription_id');
            return redirect($response['links'][0]['href']);
            // redirect($response['links'][0]['href']);
        } else {
            $user_subscription_reccuring = new UserSubscriptionRecurring();
            $user_subscription_reccuring->user_id = $user_subscription->customer_id;
            $user_subscription_reccuring->user_subscription_id = $user_subscription->id;
            $user_subscription_reccuring->paypal_subscription_id = null;
            $user_subscription_reccuring->status = 'CANCELLED';
            $user_subscription_reccuring->save();
            Session::flash('affiliate_id', null);

            session()->forget('data');
            session()->forget('user_subscription_id');
            return redirect()->route('paypal.thank-you');
        }
    }

    public function thankYou()
    {
        return view('frontend.pages.thankyou');
    }

    public function paypalPayFailed($err = null)
    {
        return view('frontend.pages.payment-failed');
    }

    public function paypalSuccessPaymentRecurring(Request $request)
    {
        $user_subscription_reccuring_id = session()->get('user_subscription_reccuring_id');
        UserSubscriptionRecurring::where('id', $user_subscription_reccuring_id)->update(['status' => 'ACTIVE']);
        session()->forget('user_subscription_reccuring_id');
        return view('frontend.pages.thankyou');
    }

    public function paypalPayRecurringFailed($err = null)
    {
        $user_subscription_reccuring_id = session()->get('user_subscription_reccuring_id');
        UserSubscriptionRecurring::where('id', $user_subscription_reccuring_id)->update(['status' => 'CANCELLED']);
        session()->forget('user_subscription_reccuring_id');
        return view('frontend.pages.thankyou');
    }
}
