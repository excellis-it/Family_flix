<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusinessManagement;

class businessManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $business = [
            [
                'banner_image' => 'business_management/faq_banner.png',
                'banner_heading' => 'Frequently Asked Questions',
                'content' => '',
                'type' => 'faq',
            ],
            [
                'banner_image' => 'business_management/privacy_banner.png',
                'banner_heading' => 'Privacy Policy',
                'content' => 'Welcome to The Family Flix! Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our service. We respect your privacy and are committed to protecting it through our compliance with this policy.

                Information We Collect
                Personal Information: We collect personal information you voluntarily provide to us, such as your name, email address, billing information, and any other information you choose to provide.
                Usage and Device Information: When you access our service, we automatically collect information about your device and your usage of our service, including IP addresses, browser type, access times, pages viewed, and the page you visited before navigating to our service.
                How We Use Your Information
                We use the information we collect about you to:
                Provide, maintain, and improve our service;
                Process transactions and send you related information, including confirmations and invoices;
                Send you technical notices, updates, security alerts, and support and administrative messages;
                Respond to your comments, questions, and requests, and provide customer service;
                Communicate with you about products, services, offers, promotions, and provide news and information we think will be of interest to you.
                Sharing Your Information
                We may share your information as follows:
                With vendors, consultants, and other service providers who need access to such information to carry out work on our behalf;
                In response to a request for information if we believe disclosure is in accordance with, or required by, any applicable law or legal process;
                If we believe your actions are inconsistent with our user agreements or policies, or to protect the rights, property, and safety of The Family Flix or others;
                In connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business by another company;
                Between and among The Family Flix and our current and future parents, affiliates, subsidiaries, and other companies under common control and ownership.
                Your Choices
                You have several choices regarding the use of information on our service:
                Account Information: You may update, correct or delete information about you at any time by logging into your online account.
                Cookies: You can set your browser to refuse all or some browser cookies, or to alert you when cookies are being sent.
                Promotional Communications: You may opt out of receiving promotional emails from The Family Flix by following the instructions in those emails.
                Security
                We take reasonable measures to help protect information about you from loss, theft, misuse, unauthorized access, disclosure, alteration, and destruction.
                International Transfers
                We are based in United States and the information we collect is governed by United States law. By accessing or using the Services or otherwise providing information to us, you consent to the processing and transfer of information in and to the U.S. and other countries.
                Changes to This Privacy Policy
                We may update this Privacy Policy from time to time. If we make material changes, we will notify you by revising the date at the top of the policy and, in some cases, we may provide you with more prominent notice.
                Contact Us
                If you have any questions about this Privacy Policy, please contact us at: [Insert Contact Information].
                
                This Privacy Policy is intended to help you understand your privacy rights regarding our collection, use, and sharing of your personal information. Your use of The Family Flix signifies your acceptance of this Privacy Policy.',
                'type' => 'privacy-policy',
                
            ],
            [
                'banner_image' => 'business_management/term_banner.png',
                'banner_heading' => 'Term & Conditions',
                'content' => 'Welcome to Family Flix! By accessing our website or using our services, you agree to be bound by the following terms and conditions (the "Terms"). Please read them carefully. If you do not agree with these Terms, you must not use our services.
                Acceptance of Terms
                Family Flix provides a digital platform for streaming movies, TV series, and exclusive content. These Terms govern your use of Family Flix and any related services provided by us.
                Use of Service
                Eligibility: You must be at least 18 years of age to create an account on Family Flix and use the service.
                Account Responsibility: You are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer. You agree to accept responsibility for all activities that occur under your account or password.
                Permitted Use: The content provided on Family Flix is for your personal and non-commercial use only. You agree not to use the service for public performances.
                Content
                Ownership: All content provided on Family Flix, including text, graphics, logos, images, and videos, is owned by Family Flix or its content suppliers and protected by international copyright and trademark laws.
                License: Family Flix grants you a limited, non-exclusive, non-transferable license to access and view the content on Family Flix for personal, non-commercial purposes as provided by these Terms.
                Restrictions
                You agree not to:
                Use the service for any illegal purpose or in violation of any local, state, national, or international law;
                Violate or encourage others to violate the rights of third parties, including intellectual property rights;
                Post, upload, or distribute any content that is unlawful, defamatory, invasive of privacy, or otherwise objectionable;
                Attempt to interfere with, compromise the system integrity or security, or decipher any transmissions to or from the servers running the service.
                Termination
                Family Flix reserves the right to terminate your account or restrict access to the service at any time, without notice, for any reason, including violation of these Terms.
                Disclaimer of Warranties
                The service is provided on an "as is" and "as available" basis. Family Flix expressly disclaims any warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, or non-infringement.
                Limitation of Liability
                Family Flix shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including but not limited to, loss of profits, data, use, goodwill, or other intangible losses resulting from your access to or use of or inability to access or use the service.
                Changes to Terms
                Family Flix reserves the right, at its sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days notice prior to any new terms taking effect.
                Governing Law
                These Terms shall be governed and construed in accordance with the laws of United States, without regard to its conflict of law provisions.
                Contact Us
                If you have any questions about these Terms, please contact us at: [Insert Contact Information].
                
                By using Family Flix, you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.
                ',
                'type' => 'term-condition',
            ],
        ];

        foreach ($business as $value) {
            BusinessManagement::create(array(
                'banner_image' => $value['banner_image'],
                'banner_heading' => $value['banner_heading'],
                'content' => $value['content'],
                'type' => $value['type'],
            ));
        }

    }
}
