<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
        [   'type' => 'general',
            'question' => 'What is The Family Flix?',
            'answer' => 'The Family Flix is a comprehensive streaming service that offers a vast library of movies, TV series, and exclusive content from multiple platforms including Netflix, Amazon Prime, Hulu, Disney Plus, and more, all under one roof. Our service is designed to provide an affordable and convenient alternative to managing multiple subscriptions.',
        ],
        [
            'type' => 'general',
            'question' => 'How does The Family Flix offer content from different streaming platforms?',
            'answer' => 'We have agreements with various content providers and streaming platforms to legally host and stream their content on our platform. This allows our subscribers to enjoy a wide range of entertainment without the need for multiple subscriptions.',

        ],
        [
            'type' => 'general',
            'question' => 'What subscription plans are available?',
            'answer' => 'The Family Flix offers several subscription plans tailored to meet different needs and preferences. Our plans vary based on the number of screens that can be used simultaneously, video quality, and access to exclusive content. For detailed information on our plans, please visit our Subscription Plans page.',

        ],
        [
            'type' => 'general',
            'question' => 'Can I watch content on The Family Flix without an internet connection?',
            'answer' => 'Yes, The Family Flix offers a download feature for mobile and tablet devices, allowing you to download your favorite shows and movies to watch offline. This feature is perfect for keeping entertained while on the move without internet access.',

        ],
        [
            'type' => 'general',
            'question' => 'How can I watch The Family Flix on my TV?',
            'answer' => 'The Family Flix is compatible with various devices including smart TVs, streaming media players, gaming consoles, and more. You can also cast The Family Flix from your mobile device or computer to your TV using Chromecast or AirPlay.',

        ],
        [
            'type' => 'general',
            'question' => 'Are there any parental controls available?',
            'answer' => 'Yes, The Family Flix provides comprehensive parental controls allowing you to set viewing restrictions and create a safe viewing environment for children. You can customize profiles with age-appropriate content filters.',

        ],
        [
            'type' => 'general',
            'question' => 'Can I share my account with friends and family?',
            'answer' => 'Our subscription plans include options to create multiple user profiles and allow simultaneous streaming on multiple devices. You can share your account with friends and family according to the terms of your selected plan.',

        ],
        [   'type' => 'payment',
            'question' => 'How do I sign up for The Family Flix?',
            'answer' => 'Visit our website and click on the “Sign Up” button. Follow the simple steps to create your account, and you’ll be ready to enjoy our vast content library.',
        ],
        [
            'type' => 'payment',
            'question' => 'What devices can I use to access The Family Flix?',
            'answer' => 'The Family Flix is compatible with all major platforms, including mobile devices, tablets, and smart TVs. Download our app for a seamless viewing experience.',

        ],
        [
            'type' => 'payment',
            'question' => 'Is there a free trial available?',
            'answer' => 'Yes, we offer a free trial period for new subscribers. Explore our content and features risk-free before committing to a subscription.',

        ],
        [
            'type' => 'payment',
            'question' => 'How can I cancel my subscription?',
            'answer' => 'You can easily manage your subscription in the account settings on our website. If you need assistance, our customer support team is available 24/7 to guide you through the process.',

        ],
        [
            'type' => 'payment',
            'question' => 'Can I switch plans or upgrade my subscription?',
            'answer' => 'Absolutely! You can upgrade or switch plans at any time. Visit your account settings to make the changes that suit your entertainment needs.',
        ],
        [
            'type' => 'payment',
            'question' => 'Are there any hidden fees or contracts?',
            'answer' => 'No hidden fees or long-term contracts. The Family Flix believes in transparency and providing you with a straightforward, hassle-free entertainment experience.',
        ],
    ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
