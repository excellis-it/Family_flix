<?php

namespace Database\Seeders;

use App\Models\StripeCredential;
use App\Models\PaymentDetailMail;
use Illuminate\Database\Seeder;

class PaypalCredentialSeeder extends Seeder
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
            //     'client_id' => 'AQk9j4pjM8c95pTYsRrSaQfGZMc64Jw9Ev_UlwL5dBYKYDOOm7WXQh3AwIpu1vUI24cR5wsslK_mhuCW',
            //     'client_secret' => 'EDMj_9El7IanX88iYHIz22rsEVHKpBSwZOmVKq2d3KSQGRU20dbVOV3RKwOhBwDDP5MLZyzoKH_f1guW',
            //     'credential_name' => 'sandbox',
            //     'status' => 1
            // ],
            // [
            //     'client_id' => 'AZ2CsFSUDXQb9-659zFIxzkxQfW-gxdF4AOUAWtC_01TiGlJ2idzmSr78F0UQnTqrPTsSgCXVC0mogTT',
            //     'client_secret' => 'AZ2CsFSUDXQb9-659zFIxzkxQfW-gxdF4AOUAWtC_01TiGlJ2idzmSr78F0UQnTqrPTsSgCXVC0mogTT',
            //     'credential_name' => 'live',
            //     'status' => 0
            // ]

            [
                'stripe_key' => 'pk_test_51MoLKTG3jwiO2rYEZuRg2AHzIwP532Po6T5SxkJy9nhKy1IfKFr2wcAcbk3hLe04QPdDELYJYghB7562hUkcZd3600bL6OWxUZ',
                'stripe_secret' => 'sk_test_51MoLKTG3jwiO2rYEeOxG1gjYRFvWGvACsX6fqpVP6E04yXRNkVx7LFXNkaqiCuKNFchF0LOlzRzXFBuyShcstsQ000aohwwaul',
                'credential_name' => 'sandbox',
                'status' => 1
            ],

            [
                'stripe_key' => 'pk_test_51MoLKTG3jwiO2rYEZuRg2AHzIwP532Po6T5SxkJy9nhKy1IfKFr2wcAcbk3hLe04QPdDELYJYghB7562hUkcZd3600bL6OWxUZ',
                'stripe_secret' => 'sk_test_51MoLKTG3jwiO2rYEeOxG1gjYRFvWGvACsX6fqpVP6E04yXRNkVx7LFXNkaqiCuKNFchF0LOlzRzXFBuyShcstsQ000aohwwaul',
                'credential_name' => 'live',
                'status' => 0
            ]
        ];

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
