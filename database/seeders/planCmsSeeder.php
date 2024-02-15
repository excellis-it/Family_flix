<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanCms;

class planCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $plan_cms = PlanCms::create([
            'title' => 'Your Plan, Your Choice.',
            'banner_img' => 'plan/plan-bnr.png',
            'short_description' => 'Welcome to The Family Flix subscription pricing page, where we believe in providing you with affordable options for an unlimited entertainment experience. Choose a plan that suits your preferences and enjoy seamless access to a vast content library. Our pricing is designed to offer unbeatable value, ensuring that you get the most out of your entertainment budget. Pricing Plans & Options.',
            'main_title' => 'Pricing Plans & Options',
            'background_img' => 'plan/pricing-plan-bg.png',
            'middle_back_img' => 'plan/offer-bg.png',
            'middle_content' => 'Subscribe today and unlock a world of entertainment that fits your lifestyle. The Family Flix is here to make your viewing experience extraordinary, affordable, and tailored just for you. Thank you for choosing us as your entertainment destination.',
            'anime1_img' => 'plan/offer-1.png',
            'anime2_img' => 'plan/offer-2.png',
            'title1' => 'Exclusive Offer for New Subscribers',
            'description1' =>'Subscribe now and get an exclusive 20% OFF your first month with the code: NEWFAMILY. This limited-time offer is our way of welcoming you to The Family Flix community.',
            'title2' => 'No Hidden Fees, No Commitment',
            'description2' => 'At The Family Flix, we believe in transparency. Our pricing includes all taxes and fees, and there are no hidden charges. Plus, there’s no long-term commitment – you can cancel or change your plan at any time.'

        ]);

    }
}
