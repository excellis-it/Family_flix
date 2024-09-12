<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait PayPalTrait
{
    private $token;
    private $paypal_url;

    function __construct()
    {
        $this->token = $this->getToken();
        $this->paypal_url = $this->getPaypalCredentials()['credential_name'] == 'sandbox' ? 'https://api-m.sandbox.paypal.com/v1/' : 'https://api.paypal.com/v1/';
    }
    // get paypal credentials active
    public function getPaypalCredentials()
    {
        return \App\Models\PaypalCredential::where('status', 1)->first();
    }

    // get paypal token
    public function getToken()
    {
        $paypal_credentials = $this->getPaypalCredentials();
        if ($paypal_credentials['credential_name'] == 'sandbox') {
            $url = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
        } else {
            $url = 'https://api.paypal.com/v1/oauth2/token';
        }

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

    // create product in paypal

    public function createProduct($data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->paypal_url . 'catalogs/products');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    // create plan in paypal
    public function createPlan($data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->paypal_url . 'billing/plans');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    // Update pricing in paypal

    public function updatePricing($data, $plan_id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->paypal_url . 'billing/plans/' . $plan_id . '/update-pricing-schemes');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

}
