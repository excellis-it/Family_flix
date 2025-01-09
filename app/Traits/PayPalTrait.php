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
        // return $this->getPaypalCredentials();
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



    public function getSubscriptionDetails($subscription_id)
    {
        // Fetch active PayPal credentials
        $paypal_credentials = PaypalCredential::where('status', 1)->first();

        if (!$paypal_credentials) {
            throw new \Exception('PayPal credentials not found.');
        }

        // Determine URLs based on environment
        $base_url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/'
            : 'https://api.paypal.com/v1/';

        $auth_url = $base_url . 'oauth2/token';
        $subscription_url = $base_url . 'billing/subscriptions/' . $subscription_id;

        // Get PayPal access token
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $auth_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $paypal_credentials['client_id'] . ':' . $paypal_credentials['client_secret']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception('Error fetching PayPal access token: ' . curl_error($curl));
        }

        curl_close($curl);

        $response_data = json_decode($response, true);

        if (!isset($response_data['access_token'])) {
            throw new \Exception('Failed to retrieve PayPal access token. Response: ' . $response);
        }

        $access_token = $response_data['access_token'];

        // Fetch subscription details
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $subscription_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token
        ]);
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new \Exception('Error fetching subscription details: ' . curl_error($curl));
        }

        curl_close($curl);

        $subscription_details = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error decoding subscription details response: ' . json_last_error_msg());
        }

        return $subscription_details;
    }




    // Subscribe a user to a plan
    public function subscribeUser($recurring)
    {
        $paypal_credentials = PaypalCredential::where('status', 1)->first();
        $url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/oauth2/token'
            : 'https://api.paypal.com/v1/oauth2/token';

        $bill_url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/billing/subscriptions'
            : 'https://api.paypal.com/v1/billing/subscriptions';

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
        curl_setopt($curl, CURLOPT_URL, $bill_url);

        // Specify that this is a POST request
        curl_setopt($curl, CURLOPT_POST, true);

        // Set return transfer to true to return the result of the request
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Add necessary headers, including the Bearer token
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token
        ]);

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($recurring));
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            // If there is an error, return the error message
            return curl_error($curl);
        }
        curl_close($curl);
        return json_decode($response, true);
    }

    public function getPaymentBillingDetails($paymentId)
    {
        $paypal_credentials = PaypalCredential::where('status', 1)->first();
        $pay_url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v1/oauth2/token'
            : 'https://api.paypal.com/v1/oauth2/token';

        $bill_url = $paypal_credentials['credential_name'] == 'sandbox'
            ? 'https://api-m.sandbox.paypal.com/v2/'
            : 'https://api.paypal.com/v2/';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $pay_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $paypal_credentials['client_id'] . ':' . $paypal_credentials['client_secret']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $response = curl_exec($curl);
        curl_close($curl);
        // return $paymentId;
        $access_token = json_decode($response)->access_token;
        // Ensure the base URL ends with a slash, so we correctly append the path
        $url = rtrim($bill_url, '/') . "/checkout/orders/{$paymentId}/capture";

        // Debugging: Log or output the URL to check its correctness
        \Log::debug('PayPal URL: ' . $url);  // Log the URL to check its correctness

        // cURL setup
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $access_token
        ]);

        $response = curl_exec($curl);

        // Error handling
        if (curl_errno($curl)) {
            curl_close($curl);
            return curl_error($curl);  // Return the cURL error message
        }

        curl_close($curl);

        // Check for successful response and parse the JSON
        $paymentDetails = json_decode($response, true);

        // If the response is invalid or not successful
        if (!isset($paymentDetails['id']) || $paymentDetails['id'] !== $paymentId) {
            return "Invalid payment details.";
        }

        // If a shipping address is found, return it
        if (isset($paymentDetails['payer']['payer_info']['shipping_address'])) {
            $shippingAddress = $paymentDetails['payer']['payer_info']['shipping_address'];

            // Format the address as needed
            $address = [
                "address_line_1" => $shippingAddress['line1'] ?? null,
                "address_line_2" => $shippingAddress['line2'] ?? null,
                "admin_area_2" => $shippingAddress['city'] ?? null,
                "admin_area_1" => $shippingAddress['state'] ?? null,
                "postal_code" => $shippingAddress['postal_code'] ?? null,
                "country_code" => $shippingAddress['country_code'] ?? null,
            ];

            return $address;
        }

        // Return null if no address is found
        return null;
    }
}
