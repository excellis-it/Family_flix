<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscribeCms;

class subscriptionCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $subscriptionCms = new SubscribeCms();
        $subscriptionCms->section1_title = 'Experience Cinematic Magic Today! Subscribe to The Family Flix.';
        $subscriptionCms->section1_description = 'Are you ready to embark on an unparalleled entertainment journey? Join The Family Flix community now and unlock a world of cinematic wonders!';
        $subscriptionCms->section1_background_img = 'subscription/subscription-bg.png';
        $subscriptionCms->section1_button_name = 'Sign Up Today';
        $subscriptionCms->subscribe_title = 'Subscribe For Updates.';
        $subscriptionCms->subscription_placeholder = 'Enter your Email';
        $subscriptionCms->button_name = 'Subscribe';
        $subscriptionCms->save();
    }
}
