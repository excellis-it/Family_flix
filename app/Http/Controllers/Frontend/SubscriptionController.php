<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Subscription;

class SubscriptionController extends Controller
{
    //
    public function createSubscription(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = Auth::user();
        // Create or retrieve the customer
        $customer = Customer::retrieve('cus_NfCK0GW1JY2SYF');

        // $customer = Customer::create([
        //     'email' => $request->email,
        //     'name' => $request->name,
        //     'source' => $request->stripeToken, // Or use 'payment_method'
        // ]);
        
        
      

        // Check if the payment method is already attached
        $paymentMethod = PaymentMethod::retrieve('pm_1Q0310G3jwiO2rYES1ugpquF'); // Replace with actual Payment Method ID

        // If the payment method is not attached, attach it
        if ($paymentMethod->customer !== $customer) {
            $paymentMethod->attach(['customer' => $customer]);
        }

        // Use the correct Price ID from your Stripe dashboard
        $priceId = 'price_1Q02sAG3jwiO2rYEAYNbSk8c'; // Replace with actual Price ID

        // Create the subscription
        $subscription = Subscription::create([
            'customer' => $customer,
            'items' => [
                ['price' => $priceId], // Use the Stripe Price ID here
            ],
            'default_payment_method' => $paymentMethod,
            'expand' => ['latest_invoice.payment_intent'],
        ]);

        return response()->json([
            'subscription' => $subscription,
        ]);
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
