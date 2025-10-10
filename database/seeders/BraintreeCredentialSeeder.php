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
            //     'merchant_id' => 'zxhm28ppxmzfvqwd',
            //     'client_id' => '84c5hbbky7jqrdmg',
            //     'client_secret' => 'd0eed9a987abce9e171eabb1ae2233d7',
            //     'credential_name' => 'sandbox',
            //     'status' => 1
            // ],
            // [
            //     'merchant_id' => 'zxhm28ppxmzfvqwd',
            //     'client_id' => '84c5hbbky7jqrdmg',
            //     'client_secret' => 'd0eed9a987abce9e171eabb1ae2233d7',
            //     'credential_name' => 'live',
            //     'status' => 0
            // ],

            [
                'merchant_id' => 'zxhm28ppxmzfvqwd',
                'stripe_key' => '84c5hbbky7jqrdmg',
                'stripe_secret' => 'd0eed9a987abce9e171eabb1ae2233d7',
                'credential_name' => 'sandbox',
                'status' => 1
            ],

            [
                'merchant_id' => 'zxhm28ppxmzfvqwd',
                'stripe_key' => '84c5hbbky7jqrdmg',
                'stripe_secret' => 'd0eed9a987abce9e171eabb1ae2233d7',
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
