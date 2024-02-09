<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeCms;

class homeCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $homeCms = new HomeCms();
        $homeCms->top_back_image = 'home/top_back.png';
        $homeCms->top_short_title = 'Your All-In-One Entertainment Hub';
        $homeCms->top_main_title = 'Unlimited Entertainment.At Your Fingertips.';
        $homeCms->top_button_text = 'Sign Up Today';
        $homeCms->section1_main_image = 'home/section1_main.png';
        $homeCms->section1_back_image = 'home/section1_back.png';
        $homeCms->section2_back_image = 'home/section2_back.png';
        $homeCms->section2_main_image = 'home/section2_main.png';
        $homeCms->section2_title = 'Everything You Love.All In One Place.';
        $homeCms->section2_description = 'Our platform seamlessly integrates content from top streaming platforms like Netflix, Hulu, Disney, and more. Imagine having access to all your favorite shows and movies in one place, without the hassle of switching between multiple apps.';
        $homeCms->section2_short_title = 'View Our Plans And Pricing';
        $homeCms->section2_main_icon = 'home/main_icon.png';
        $homeCms->section2_icon1 = 'home/icon1.png';
        $homeCms->section2_icon2 = 'home/icon2.png';
        $homeCms->section2_icon3 = 'home/icon3.png';
        $homeCms->section2_icon4 = 'home/icon4.png';
        $homeCms->section2_icon5 = 'home/icon5.png';
        $homeCms->section2_icon6 = 'home/icon6.png';
        $homeCms->section2_icon7 = 'home/icon7.png';
        $homeCms->section2_icon8 = 'home/icon8.png';
        $homeCms->section3_back_image = 'home/section3_back.png';
        $homeCms->section3_main_image = 'home/section3_main.png';
        $homeCms->section3_title = 'How It Works';
        $homeCms->section3_video_link = 'https://www.google.com/';
        $homeCms->section4_title = 'Unbeatable Variety';
        $homeCms->section4_description = 'Blockbuster hits, binge-worthy series, and hidden gems at your fingertips. A universe of entertainment curated for you.';
        $homeCms->section4_back_image = 'home/section4_back.png';
        $homeCms->section5_back_image = 'home/section5_back.png';
        $homeCms->section5_main_image = 'home/section5_main.png';
        $homeCms->section5_main_title = "Kid's Corner";
        $homeCms->section5_main_description = 'A dedicated space filled with family-friendly movies and shows to keep the little ones entertained. From animated adventures to educational content, we’ve got it all in one safe and fun place.Subscription to The Family Flix means entertainment for the whole family, so your kids can have a blast while you enjoy your favorites.
        Subscribe today and let the young ones embark on their own cinematic journeys!';
        $homeCms->plan_section_title = 'Pricing Plans & Options.';
        $homeCms->plan_section_back_image = 'home/plan_back.png';
        $homeCms->save();
       
    }
}

