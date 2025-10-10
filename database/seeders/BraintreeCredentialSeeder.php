<?php

namespace Database\Seeders;

use App\Models\PaymentDetailMail;
use App\Models\PaypalCredential;
use App\Models\StripeCredential;
use Illuminate\Database\Seeder;

class BraintreeCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $credintial_array = [
            // [
            //     'merchant_id' => '63wmxg6vmsqrbs8w',
            //     'client_id' => '3b53hcdj6x5c2jby',
            //     'client_secret' => 'e6c9dfc48b7e83813df1df20f3168574',
            //     'credential_name' => 'sandbox',
            //     'status' => 1
            // ],
            // [
            //     'merchant_id' => '63wmxg6vmsqrbs8w',
            //     'client_id' => '3b53hcdj6x5c2jby',
            //     'client_secret' => 'e6c9dfc48b7e83813df1df20f3168574',
            //     'credential_name' => 'live',
            //     'status' => 0
            // ],

            [
                'merchant_id' => '63wmxg6vmsqrbs8w',
                'stripe_key' => '3b53hcdj6x5c2jby',
                'stripe_secret' => 'e6c9dfc48b7e83813df1df20f3168574',
                'credential_name' => 'sandbox',
                'status' => 1
            ],

            [
                'merchant_id' => '63wmxg6vmsqrbs8w',
                'stripe_key' => '3b53hcdj6x5c2jby',
                'stripe_secret' => 'e6c9dfc48b7e83813df1df20f3168574',
                'credential_name' => 'live',
                'status' => 0
            ]
        ];
        // foreach ($credintial_array as $key => $value) {
        //     PaypalCredential::create($value);
        // }

        foreach ($credintial_array as $key => $value) {
            StripeCredential::create($value);
        }

        // payment detail mail
        $payment_detail_mail = [
            [
                'email' => 'admin@yopmail.com',
                'status' => 1
            ]
        ];

        foreach ($payment_detail_mail as $key => $value) {
            PaymentDetailMail::create($value);
        }
    }
}
