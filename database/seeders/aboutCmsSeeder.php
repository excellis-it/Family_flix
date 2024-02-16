<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class aboutCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $aboutUsCms = new AboutUs();
        $aboutUsCms->title = 'About Us';
        $aboutUsCms->banner_img = 'about/abt-bg.png';
        $aboutUsCms->section1_title = 'Celebrating Your Entertainment';
        $aboutUsCms->section1_description = 'Welcome to The Family Flix, where our passion lies in
        crafting an exceptional entertainment experience that is
        both accessible and affordable, catering to your unique
        tastes. Our journey began with a simple yet ambitious
        vision – to create a platform that brings together the
        fragmented world of streaming services, providing you with
        an easier and more cost-effective way to enjoy your
        favorite movies, TV series, and more.';
        $aboutUsCms->section1_img = 'about/section1-img.png';
        $aboutUsCms->section2_title1 = 'Our Commitment to You';
        $aboutUsCms->section2_description1 = 'At The Family Flix, our commitment is unwavering. We strive to deliver the best possible entertainment experience, and our dedicated team is at your service with top-notch customer support 24/7. We understand the value of your time and money, and our goal is to assist you in making the most of both.';
        $aboutUsCms->section2_img2 = 'about/section2_img2.png';
        $aboutUsCms->section3_title = 'What Sets Us Apart';
        $aboutUsCms->section3_back_img = 'about/section3_back.png';
        $aboutUsCms->section3_title1 = 'Vast Content Library';
        $aboutUsCms->section3_description1 = 'The Family Flix takes pride in presenting an ever-expanding content library. We embrace diversity, offering a range that includes movies, TV series, anime, web series, Korean drama, and more. Whatever your interests, we have something for everyone.';
        $aboutUsCms->section3_image1 = 'about/section3_img1.png';
        $aboutUsCms->section3_title2 = 'Platform Flexibility';
        $aboutUsCms->section3_description2 = 'Enjoy the flexibility of watching your favorite shows and movies on your terms. The Family Flix supports all major platforms, whether you prefer streaming on your phone, tablet, or TV. Our user-friendly app ensures a seamless experience wherever you are.';
        $aboutUsCms->section3_image2 = 'about/section3_img2.png';
        $aboutUsCms->section3_title3 = 'Savings & Simplicity';
        $aboutUsCms->section3_description3 = 'Simplify your entertainment budget with The Family Flix’s cost-effective solutions. Bid farewell to the hassles of managing multiple subscriptions and enjoy unbeatable value for a diverse range of content.';
        $aboutUsCms->section3_image3 = 'about/section3_img3.png';
        $aboutUsCms->save();
    }
}
