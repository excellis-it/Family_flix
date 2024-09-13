<?php

namespace App\Traits;

use App\Models\PaypalCredential;
use Illuminate\Http\Request;

trait PayPalTrait
{
    private $token;
    private $paypal_url;

    function __construct()
    {
        $this->token = $this->getToken();
        $this->paypal_url = $this->getPaypalCredentials()['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/'
            : 'https://api.paypal.com/v1/';
    }

    // Get active PayPal credentials
    public function getPaypalCredentials()
    {
        return \App\Models\PaypalCredential::where('status', 1)->first();
    }

    // Get PayPal token
    public function getToken()
    {
        $paypal_credentials = $this->getPaypalCredentials();
        $url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/oauth2/token'
            : 'https://api.paypal.com/v1/oauth2/token';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $paypal_credentials['client_id'] . ':' . $paypal_credentials['client_secret']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->access_token;
    }

    // Create a product in PayPal
    public function createProduct($data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->paypal_url . 'catalogs/products');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    // Create a billing plan in PayPal
    public function createPlan($data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->paypal_url . 'billing/plans');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    // Update pricing for a billing plan in PayPal
    public function updatePricing($data, $plan_id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->paypal_url . 'billing/plans/' . $plan_id . '/update-pricing-schemes');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    // Subscribe a user to a plan
    public function subscribeUser($recurring)
    {
        $paypal_credentials = PaypalCredential::where('status', 1)->first();
        $url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/oauth2/token'
            : 'https://api.paypal.com/v1/oauth2/token';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $paypal_credentials['client_id'] . ':' . $paypal_credentials['client_secret']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $response = curl_exec($curl);
        curl_close($curl);

        $access_token = json_decode($response)->access_token;

        $curl = curl_init();

        // Set the correct PayPal subscription endpoint
        curl_setopt($curl, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions');

        // Specify that this is a POST request
        curl_setopt($curl, CURLOPT_POST, true);

        // Set return transfer to true to return the result of the request
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Add necessary headers, including the Bearer token
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token
        ]);

        // Add the recurring subscription data (plan_id, subscriber, etc.)
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($recurring));

        // Execute the cURL request
        $response = curl_exec($curl);

        // Check for errors
        if (curl_errno($curl)) {
            // If there is an error, return the error message
            return curl_error($curl);
        }

        // Close the cURL session
        curl_close($curl);

        // Return the response from PayPal (subscription details)
        return json_decode($response, true);
    }
}
