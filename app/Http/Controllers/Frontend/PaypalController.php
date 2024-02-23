<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Omnipay\Omnipay;


class PaypalController extends Controller
{
    //
    private $gateway;
  
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function createPayments($id)
    {
        $id = decrypt($id);
        $plan = Plan::find($id);
        return view('frontend.pages.checkout',compact('plan'));
    }
   

    public function processPayments(Request $request)
    {
       
        if($request->all())
        {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => '100',
                    'currency' => 'USD',
                    'returnUrl' => route('payment.success'),
                    'cancelUrl' => route('payment.success'),
                ))->send();
           
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }

            



        }

    }
}
