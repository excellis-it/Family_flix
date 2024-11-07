<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class addFirstTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->truncate();
        DB::table('email_templates')->insert([
            'name' => 'Email Template 1',
            'subject' => 'Affiliate Marketer Login Details',
            'title' => 'Welcome to The Family Flix!',
            'content' => '  <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;"> Dear {customer_name},</p>
                                <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;">Congratulations and welcome! Your multimedia account with The Family Flix has been successfully created, and we’re excited to have you join our growing family of satisfied customers. We’re confident that you’ll enjoy the entertainment and features we have to offer.
                                    To start enjoying your content, simply visit your customer dashboard, download our multimedia app, and use the login details provided below:
                                </p>
                                <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;">
                                    Login Information:{login_information}
                                </p>
                                <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;">
                                    Account Number:  {account_number}
                                </p>
                                <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;">
                                    Password: {password}
                                </p>
                                <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;">
                                    If you have any questions or need assistance, our dedicated support team is here to help. Feel free to reach out to us at support@thefamilyflix.com or visit our website at thefamilyflix.com for helpful resources.
                                    <br>
                                    Should you need to add your cloud to the app, please follow the simple steps outlined in the image below.
                                    <br>
                                    Thank you for choosing The Family Flix. We look forward to bringing you the best in entertainment!
                                </p>
                                <p style="font-size:16px; color:#313131; line-height:24px; font-weight: 500;">
                                    Warm regards,<br>{company_name}
                                </p>     ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
