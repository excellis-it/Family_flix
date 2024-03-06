<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCms;
use App\Models\AboutUs;
use App\Models\ContactUsCms;


class CmsController extends Controller
{

    /**
     * Home Page Api
     * @response 200{
     *      "status": true,
     *       "message": "Home CMS data fetched successfully",
     *      "statusCode": "200",
     *      "data": {
     *          "id": 1,
     *          "top_back_image": "home/top_back.png",
     *          "top_short_title": "Your All-In-One Entertainment Hub",
     *          "top_main_title": "Unlimited Entertainment.At Your Fingertips.",
     *          "top_button_text": "Sign Up Today",
     *          "section1_main_image": "home/section1_main.png",
     *          "section1_back_image": "home/section1_back.png",
     *          "section2_back_image": "home/section2_back.png",
     *          "section2_main_image": "home/section2_main.png",
     *          "section2_title": "Everything You Love.All In One Place.",
     *          "section2_description": "Our platform seamlessly integrates content from top streaming platforms like Netflix, Hulu, Disney, and more. Imagine having access to all your favorite shows and movies in one place, without the hassle of switching between multiple apps.",
     *          "section2_short_title": "View Our Plans And Pricing",
     *          "section2_main_icon": "home/main_icon.png",
     *          "entertainment_title": "Entertainment Everywhere",
     *          "entertainment_description": "Enjoy The Family Flix app on your TV, mobile, and tablet. Our platform supports all your devices. Anywhere, Any Device: The Family Flix Advantage",
     *          "section3_back_image": "home/section3_back.png",
     *          "section3_main_image": "home/section3_main.png",
     *          "section3_title": "How It Works",
     *          "section3_video_link": "home/4YGx75Dq9sxjUK2dMWThhIVSrYjWo9ZPNkFieaHq.mp4",
     *          "section4_title": "Unbeatable Variety",
     *          "section4_description": "Blockbuster hits, binge-worthy series, and hidden gems at your fingertips. A universe of entertainment curated for you.",
     *          "section4_back_image": "home/section4_back.png",
     *          "section5_back_image": "home/section5_back.png",
     *          "section5_main_title": "Kid's Corner",
     *          "section5_main_description": "<p>A dedicated space filled with family-friendly movies and shows to keep the little ones entertained. From animated adventures to educational content, we&rsquo;ve got it all in one safe and fun place.Subscription to The Family Flix means entertainment for the whole family, so your kids can have a blast while you enjoy your favorites. Subscribe today and let the young ones embark on their own cinematic journeys!</p>",
     *          "section5_main_image": "home/section5_main.png",
     *          "plan_section_title": "Pricing Plans & Options.",
     *          "plan_section_back_image": "home/plan_back.png",
     *          "created_at": "2024-03-06T05:24:23.000000Z",
     *          "updated_at": "2024-03-06T05:35:15.000000Z"
     *      },
     * }
     *
     * @response 201{
     *      "status": false,
     *     "message": "No Data Found",
     *    "statusCode": "401",
     * }
     */
    public function homeCms()
    {
        try{
            $home_cms = HomeCms::first();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $home_cms,
                'message' => 'Home CMS data fetched successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * About Page Api
     * @response 200{
     *  "status": true,
     *  "statusCode": 200,
     *  "data": {
     *       "id": 1,
     *       "title": "About Us",
     *       "banner_img": "about/abt-bg.png",
     *       "section1_title": "Celebrating Your Entertainment",
     *       "section1_description": "Welcome to The Family Flix, where our passion lies in\r\n        crafting an exceptional entertainment experience that is\r\n        both accessible and affordable, catering to your unique\r\n        tastes. Our journey began with a simple yet ambitious\r\n        vision – to create a platform that brings together the\r\n        fragmented world of streaming services, providing you with\r\n        an easier and more cost-effective way to enjoy your\r\n        favorite movies, TV series, and more.",
     *       "section1_img": "about/section1-img.png",
     *       "section2_title1": "Our Commitment to You",
     *       "section2_description1": "At The Family Flix, our commitment is unwavering. We strive to deliver the best possible entertainment experience, and our dedicated team is at your service with top-notch customer support 24/7. We understand the value of your time and money, and our goal is to assist you in making the most of both.",
     *       "section2_img2": "about/section2_img2.png",
     *       "section3_title": "What Sets Us Apart",
     *       "section3_back_img": "about/section3_back.png",
     *       "section3_title1": "Vast Content Library",
     *       "section3_description1": "The Family Flix takes pride in presenting an ever-expanding content library. We embrace diversity, offering a range that includes movies, TV series, anime, web series, Korean drama, and more. Whatever your interests, we have something for everyone.",
     *       "section3_image1": "about/section3_img1.png",
     *       "section3_title2": "Platform Flexibility",
     *       "section3_description2": "Enjoy the flexibility of watching your favorite shows and movies on your terms. The Family Flix supports all major platforms, whether you prefer streaming on your phone, tablet, or TV. Our user-friendly app ensures a seamless experience wherever you are.",
     *       "section3_image2": "about/section3_img2.png",
     *       "section3_title3": "Savings & Simplicity",
     *       "section3_description3": "Simplify your entertainment budget with The Family Flix’s cost-effective solutions. Bid farewell to the hassles of managing multiple subscriptions and enjoy unbeatable value for a diverse range of content.",
     *       "section3_image3": "about/section3_img3.png",
     *       "created_at": "2024-03-06T05:24:23.000000Z",
     *       "updated_at": "2024-03-06T05:24:23.000000Z"
     *   },
     *  "message": "About CMS data fetched successfully"
     * }
     * @response 201{
     * "status": false,
     * "statusCode": 500,
     * "message": "No Data Found"
     * }
     */


    public function aboutCms()
    {
        try{
            $about_us = AboutUs::first();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $about_us,
                'message' => 'About CMS data fetched successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);
        }
       
    }

    /**
     * Contact Page Api
     * @response 200{
     * "status": true,
     * "statusCode": 200,
     *   "data": {
     *       "id": 1,
     *       "title": "Contact",
     *       "banner_img": "contact/contact-banner.png",
     *       "background_img": "contact/contact-bg.png",
     *       "main_title": "Connect With Us",
     *       "short_title": "To learn more about how Streamit can help you, contact us.",
     *       "button_name": "Contact Us",
     *       "map_link": "https://maps.google.com/maps?q=Orlando%2C%20Florida&t=m&z=15&output=embed&iwloc=near",
     *       "created_at": "2024-03-06T05:24:23.000000Z",
     *       "updated_at": "2024-03-06T05:24:23.000000Z"
     *    },
     *  "message": "Contact CMS data fetched successfully"
     * }
     * @response 201{
     * "status": false,
     * "statusCode": 500,
     * "message": "No Data Found"
     * }
     */

    public function contactCms()
    {
        try{
            $contact_cms = ContactUsCms::first();
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'data' => $contact_cms,
                'message' => 'Contact CMS data fetched successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage()
            ]);

        } 
    }
}
