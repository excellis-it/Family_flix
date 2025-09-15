<?php

namespace App\Http\Controllers\AffiliateMarketer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use App\Models\StripeConnect;
use App\Models\User;
use App\Models\WalletMoneyTransaction;
use Braintree\Gateway;
use Stripe\OAuth;
use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    private $stripe;
    protected $gateway;
    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }




    public function walletList()
    {
        $wallets = Wallet::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        return view('frontend.affiliate-marketer.wallet.list')->with(compact('wallets'));
    }

    public function walletFetchData(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query', ''); // Default to empty string if not set
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
                ->paginate(15);

            return response()->json(['data' => view('frontend.affiliate-marketer.wallet.filter', compact('wallets'))->render()]);
        }
    }


    public static function stripeUrl()
    {
        $queryData = [
            'response_type' => 'code',
            'client_id' => env('STRIPE_CLIENT_ID'),
            'scope' => 'read_write',
            'redirect_uri' => env('STRIPE_REDIRECT_URI'),
        ];
        $connectUri = 'https://connect.stripe.com/oauth/authorize' . '?' . http_build_query($queryData);
        return $connectUri;
    }

    public function redirect(Request $request)
    {
        // $request->all();


        $token = $this->getToken($request->code);
        if (!empty($token['error'])) {
            return redirect()->back()->with('error', $token['error']);
        }
        $connectedAccountId = $token->stripe_user_id;
        $account = $this->getAccount($connectedAccountId);
        if (Auth::user()->stripeConnect && Auth::user()->stripeConnect->exists()) {
            $stripeAccount = StripeConnect::where('user_id', Auth::user()->id)->first();
            $message = 'Stripe account updated successfully.';
        } else {
            $stripeAccount = new StripeConnect();
            $message = 'Stripe account connected successfully.';
        }
        $stripeAccount->user_id = auth()->user()->id;
        $stripeAccount->account_id = $account['id'];
        $stripeAccount->country = $account['country'];
        $stripeAccount->stripe_email = $account['email'];
        $stripeAccount->type = $account['type'];
        $stripeAccount->save();

        if (!empty($account['error'])) {
            return redirect()->back()->with('error', $account['error']);
        }
        return redirect()->route('affiliate-marketer.profile')->with('message', $message);
    }

    private function getToken($code)
    {
        $token = null;
        try {
            $token = OAuth::token([
                'grant_type' => 'authorization_code',
                'code' => $code
            ]);
        } catch (\Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function getAccount($connectedAccountId)
    {
        $account = null;
        try {
            $account = $this->stripe->accounts->retrieve(
                $connectedAccountId,
                []
            );
        } catch (\Exception $e) {
            $account['error'] = $e->getMessage();
        }
        return $account;
    }

    public function walletMoneyTransferList()
    {
        //  if(auth()->user()->stripeConnect()->exists()){
        $wallet_money_transfer = WalletMoneyTransaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
        $braintreeToken = $this->gateway->clientToken()->generate();
        return view('frontend.affiliate-marketer.wallet.transfer')->with(compact('wallet_money_transfer', 'braintreeToken'));
        //  } else {
        //      return redirect()->route('affiliate-marketer.profile')->with('error', 'Please create stripe account first');
        // }
    }

    public function walletMoneyTransferFetchData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query', ''); // Default to empty string if not set
            $wallet_money_transfer = WalletMoneyTransaction::query()
                ->where('user_id', Auth::user()->id)
                ->where(function ($q) use ($query) {
                    $q->where('transaction_amount', 'like', '%' . $query . '%')
                        ->orWhere('transaction_type', 'like', '%' . $query . '%')
                        ->orWhere('last_available_balance', 'like', '%' . $query . '%')
                        ->orWhere('created_at', 'like', '%' . $query . '%');
                })
                ->paginate(10);

            return response()->json(['data' => view('frontend.affiliate-marketer.wallet.filter-transfer', compact('wallet_money_transfer'))->render()]);
        }
    }

    // public function walletMoneyTransfer(Request $request)
    // {
    //     $request->validate([
    //         'amount' => 'required|numeric|min:1',
    //     ],[
    //         'amount.required' => 'Please put a valid amount.',
    //         'amount.numeric' => 'Please put a valid amount.',
    //         'amount.min' => 'Please put at least 1 amount.',
    //     ]);

    //     // $wallet = Wallet::where('user_id', Auth::user()->id)->sum('balance');
    //     if(auth()->user()->stripeConnect()->exists()){
    //         if (auth()->user()->wallet_balance < $request->amount) {
    //             return redirect()->back()->with('error', 'Insufficient balance.');
    //         }
    //     } else {
    //          return redirect()->route('affiliate-marketer.profile')->with('error', 'Please create stripe account first');
    //     }

    //     try {

    //         $transfer = $this->stripe->transfers->create([
    //             'amount' => $request->amount * 100,
    //             'currency' => 'usd',
    //             'destination' => Auth::user()->stripeConnect->account_id,
    //         ]);

    //         // dd($transfer);
    //         if (isset($transfer->id)) {
    //             $wallet = User::find(Auth::user()->id);
    //             $wallet_money_transfer = new WalletMoneyTransaction();
    //             $wallet_money_transfer->user_id = Auth::user()->id;
    //             $wallet_money_transfer->transaction_id = $transfer->id;
    //             $wallet_money_transfer->transaction_type = 'debit';
    //             $wallet_money_transfer->transaction_amount = $request->amount;
    //             $balance = ($wallet->wallet_balance - $request->amount);
    //             $wallet_money_transfer->last_available_balance = round($balance, 2);
    //             $wallet_money_transfer->transaction_description = 'Wallet money transfer';
    //             $wallet_money_transfer->save();

    //             // wallet balance update

    //             $wallet->wallet_balance =  $balance;
    //             $wallet->save();

    //             return redirect()->back()->with('message', 'Money transfer successfully. Please check your wallet transaction list.');
    //         } else {
    //             return redirect()->back()->with('error', 'Money transfer failed.');
    //         }

    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }


    public function walletMoneyTransfer(Request $request)
    {
        // Validation
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method_nonce' => 'required'
        ], [
            'amount.required' => 'Please put a valid amount.',
            'amount.numeric' => 'Please put a valid amount.',
            'amount.min' => 'Please put at least 1 amount.',
        ]);

        // Check wallet balance
        if (auth()->user()->wallet_balance < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient balance.');
        }

        try {
            // Perform the Braintree transaction
            $result = $this->gateway->transaction()->sale([
                'amount' => $request->amount,
                'paymentMethodNonce' => $request->payment_method_nonce,
                'options' => [
                    'submitForSettlement' => true
                ],
            ]);
             dd($result);
            // Log the result to inspect the full response
            Log::info('Braintree Transaction Result:', ['result' => $result]);

            if ($result->success) {
                // Get the transaction ID and save wallet transaction
                $transactionId = $result->transaction->id;

                $wallet = User::find(Auth::user()->id);
                $wallet_money_transfer = new WalletMoneyTransaction();
                $wallet_money_transfer->user_id = Auth::user()->id;
                $wallet_money_transfer->transaction_id = $transactionId;  // Use Braintree transaction ID
                $wallet_money_transfer->transaction_type = 'debit';
                $wallet_money_transfer->transaction_amount = $request->amount;

                // Update wallet balance
                $balance = ($wallet->wallet_balance - $request->amount);
                $wallet_money_transfer->last_available_balance = round($balance, 2);
                $wallet_money_transfer->transaction_description = 'Wallet money transfer';
                $wallet_money_transfer->save();

                // Update user wallet balance
                $wallet->wallet_balance = $balance;
                $wallet->save();

                return redirect()->back()->with('message', 'Money transfer successfully. Please check your wallet transaction list.');
            } else {
                return redirect()->back()->with('error', 'Money transfer failed: ' . $result->message);
            }
        } catch (\Throwable $th) {
            // Handle errors
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
}
