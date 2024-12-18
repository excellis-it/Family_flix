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

        DB::table('email_templates')->insert([
            'name' => 'Email Template 2',
            'subject' => 'Your "The Family Flix" Account Has Been Renewed!',
            'title' => 'Welcome to The Family Flix!',
            'content' => '<div dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px;"><span id="v1m_4703175575113258518m_3325830963273830462gmail-docs-internal-guid-e2f0c668-7fff-dde4-608d-e6dd9b4a4866"><p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">Hello,&nbsp;</span><span style="color: rgb(49, 49, 49); font-family: sans-serif; font-size: 16px; background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);">{customer_name}<br><br></span></p><p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">Congratulations! Your account with "<span style="color: rgb(49, 49, 49); font-family: sans-serif; font-size: 16px;">{company_name}</span>" has been successfully renewed. We are thrilled to see you return to our family of satisfied customers. We hope you enjoy your experience and the entertainment we have to offer.</span></p>&nbsp;</span></div><h5 style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px;"><br></h5><h5><b>Rental code:-&nbsp;</b><span style="color: rgb(49, 49, 49); font-size: 16px; background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);">{rental_code}</span></h5><div dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px;"><br></div><div dir="ltr" style=""><p dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">Please refresh the app to continue watching.</span></p><br><p dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">HOW TO RECHARGE</span></p><br><p dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">If the app is still not working after refresh!</span></p><br><p dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">Navigate to the subscription tab in the App then enter your recharge code, now refresh the App to continue watching. (ENJOY!!!)</span></p><br><p dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">Our dedicated support team is here to assist you with any questions or concerns you may have. Simply reach out to us via [<a href="mailto:support@thefamilyflix.com" rel="noreferrer" style="color: rgb(0, 105, 166); font-family: Arial, sans-serif;">support@thefamilyflix.com</a>] or visit our [<a href="https://www.thefamilyflix.com/contact-us" target="_blank">Support Page</a>] for helpful resources.</span></p><br><p dir="ltr" style="color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Verdana, Arial, Helvetica, sans-serif; font-size: 11px; line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline; background-color: transparent; color: rgb(0, 0, 0);">We thank you for choosing "<span style="color: rgb(49, 49, 49); font-family: sans-serif; font-size: 16px;">{company_name}</span>" and look forward to providing you with the best in entertainment.</span></p><br><p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; vertical-align: baseline;"><font face="Arial, sans-serif"><span style="font-size: 11pt;">Warm regards,</span><span style="font-size: 14.6667px; background-color: rgb(255, 255, 255);"><br></span></font></span><span style="color: rgb(49, 49, 49); font-size: 16px;">{company_name}</span></p></div>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
