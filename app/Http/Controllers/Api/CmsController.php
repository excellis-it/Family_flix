<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCms;
use App\Models\AboutUs;
use App\Models\ContactUsCms;
use App\Models\TopGrid;
use App\Models\EntertainmentCms;
use App\Models\PlanCms;
use App\Models\OttService;
use App\Models\SocialMedia;
use App\Models\ContactDetails;
use App\Models\Faq;
use App\Models\BusinessManagement;
use App\Models\SubscribeCms;


use Illuminate\Support\Facades\Validator;

/**
    * @group Cms
    *
    * APIs for Cms
*/


class CmsController extends Controller
{

    /**
     * Home-Page Api
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
            $ott_icons = OttService::select('id','icon')->get();
            if(!$home_cms){

                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);

            }else{
           
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'content' => $home_cms,
                    'ott_icons' => $ott_icons,
                    'message' => 'Home CMS data fetched successfully'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * About-Page Api
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
            if(!$about_us){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $about_us,
                    'message' => 'About CMS data fetched successfully'
                ]);
            }
           
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
       
    }

    /**
     * Contact-Page Api
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
            $follow_us = SocialMedia::select('id','icon','link')->get();
            $contact_details = ContactDetails::select('id','icon','title','details')->get();
            if(!$contact_cms){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $contact_cms,
                    'follow_us' => $follow_us,
                    'contact_details' => $contact_details,
                    'message' => 'Contact CMS data fetched successfully'
                ]);
            }
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);

        } 
    }

    /** 
     * Grid-Section Api
     * @response 200{
     *   "status": true,
     *   "statusCode": 200,
     *   "top_grid": [
     *       {
     *           "id": 1,
     *           "icon": "grid/grid_icon1.png",
     *           "title": "Unlimited Access",
     *           "description": "Dive into a vast library of movies, TV series, and exclusive content."
     *       },
     *       {
     *           "id": 2,
     *           "icon": "grid/grid_icon2.png",
     *           "title": "Savings Simplified",
     *           "description": "Affordable plans that eliminate the need for multiple subscriptions."
     *       },
     *       {
     *           "id": 3,
     *           "icon": "grid/grid_icon3.png",
     *           "title": "Watch Anywhere, Anytime",
     *           "description": "Enjoy your favorites on your terms - mobile, desktop, or TV."
     *       }
     *   ],
     *   "entertainment_cms": [
     *       {
     *           "id": 1,
     *           "image": "entertainment/en-1.png",
     *           "image_name": "On Your TV"
     *       },
     *       {
     *           "id": 2,
     *           "image": "entertainment/en-2.png",
     *           "image_name": "Mobiles & Tablets"
     *       },
     *       {
     *           "id": 3,
     *           "image": "entertainment/en-3.png",
     *           "image_name": "On Firestick & Firecube"
     *       }
     *   ],
     *   "message": "Grid Section CMS data fetched successfully"
     */

    public function gridSectionCms()
    {
        try{
            $grid_section = TopGrid::select('id','icon','title','description')->get();
            $entertainment_cms = EntertainmentCms::select('id','image','image_name')->get();

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'top_grid' => $grid_section,
                'entertainment_cms' => $entertainment_cms,
                'message' => 'Grid Section CMS data fetched successfully'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }

    /** 
    * Pricing-Page Api
    * @response 200{
    *   "status": true,
    *   "statusCode": 200,
    *   "plan_cms": {
    *       "id": 1,
    *       "title": "Pricing",
    *       "banner_img": "pricing/pricing-banner.png",
    *       "background_img": "pricing/pricing-bg.png",
    *       "main_title": "Pricing Plans & Options",
    *       "short_title": "Choose the plan that works best for you.",
    *       "created_at": "2024-03-06T05:24:23.000000Z",
    *       "updated_at": "2024-03-06T05:24:23.000000Z"
    *   },
    *   "message": "Pricing CMS data fetched successfully"
    * }
    * @response 201{
    * "status": false,
    * "statusCode": 500,
    * "message": "No Data Found"
    * }

    */

    public function pricingCms(Request $request)
    {
        try{
            $plan_cms = PlanCms::first();
            if($plan_cms){
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'plan_cms' => $plan_cms,
                    'message' => 'Pricing CMS data fetched successfully'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }
            
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Contact details Api
     *  @response 200
     * "status": true,
     *   "statusCode": 200,
     *   "data": [
     *       {
     *           "id": 1,
     *           "icon": "fa-solid fa-phone",
     *           "title": "Call Us",
     *           "details": "+ 18453297101"
     *       },
     *       {
     *           "id": 2,
     *           "icon": "fa-solid fa-envelope",
     *           "title": "Email Us",
     *           "details": "support@thefamilyflix.com"
     *       },
     *       {
     *           "id": 3,
     *           "icon": "fa-solid fa-location-dot",
     *           "title": "Location",
     *           "details": "Orlando Florida"
     *       },
     *       {
     *           "id": 4,
     *           "icon": "fa-regular fa-clock",
     *           "title": "Office Hours (Closed Saturday)",
     *           "details": "9am-11pm"
     *       }
     *   ],
     *   "message": "Contact Details data fetched successfully" 
     * 
     */

    public function contactDetail(Request $request)
    {
        try{
            $contact_details = ContactDetails::select('id','icon','title','details')->get();
            if(!$contact_details){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $contact_details,
                    'message' => 'Contact Details data fetched successfully'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Faq-Details Api
     * @bodyParam type string required 
     * @response 200{
     * "status": true,
     *   "statusCode": 200,
     *   "data": [
     *       {
     *           "id": 8,
     *           "type": "payment",
     *           "question": "How do I sign up for The Family Flix?",
     *           "answer": "Visit our website and click on the “Sign Up” button. Follow the simple steps to create your account, and you’ll be ready to enjoy our vast content library.",
     *           "created_at": "2024-03-12T10:44:52.000000Z",
     *           "updated_at": "2024-03-12T10:44:52.000000Z"
     *       },
     *       {
     *           "id": 9,
     *           "type": "payment",
     *           "question": "What devices can I use to access The Family Flix?",
     *           "answer": "The Family Flix is compatible with all major platforms, including mobile devices, tablets, and smart TVs. Download our app for a seamless viewing experience.",
     *           "created_at": "2024-03-12T10:44:52.000000Z",
     *           "updated_at": "2024-03-12T10:44:52.000000Z"
     *       },
     * ]
     * }

    */

    public function faqCms(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:general,payment'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 200);
        }
        try{
            $faqs = Faq::where('type',$request->type)->get();
            if(!$faqs){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $faqs,
                    'message' => 'Faq Details fetched successfully'
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
        
    }

    /** 
     *   Privacy Api
     *   @response 200{
     *   "status": true,
     *   "statusCode": 200,
     *   "data": [
     *       {
     *           "id": 2,
     *           "banner_image": "business_management/privacy_banner.png",
     *           "banner_heading": "Privacy Policy",
     *           "content": "Welcome to The Family Flix! Your privacy is important to us....",
     *           "type": "privacy-policy",
     *           "created_at": "2024-03-12T10:44:52.000000Z",
     *           "updated_at": "2024-03-12T10:44:52.000000Z"
     *       }
     *   ],
     *   "message": "Privacy Details fetched successfully"
     * }
     * 
     */

    public function privacyCms(Request $request)
    {
        try{
            $privacy = BusinessManagement::orderBy('id','desc')->where('type','privacy-policy')->get();
            if(!$privacy){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $privacy,
                    'message' => 'Privacy Details fetched successfully'
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }

     /** 
     *   Term-condition Api
     *   @response 200{
     *   "status": true,
     *   "statusCode": 200,
     *   "data": [
     *       {
     *           "id": 2,
     *           "banner_image": "business_management/term_banner.png",
     *           "banner_heading": "Term & Conditions",
     *           "content": "Welcome to Family Flix! By accessing our website or using our services, you agree to be bound by the following terms and conditions (the \"Terms\"). Please read them carefully. If you do not agree with these Terms, you must not use our services...",
     *           "type": "term-condition",
     *           "created_at": "2024-03-12T10:44:52.000000Z",
     *           "updated_at": "2024-03-12T10:44:52.000000Z"
     *       }
     *   ],
     *   "message": "Privacy Details fetched successfully"
     * }
     * 
     */

    public function termConditions(Request $request)
    {
        try{
            $terms = BusinessManagement::orderBy('id','desc')->where('type','term-condition')->get();
            if(!$terms){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $terms,
                    'message' => 'Term Details fetched successfully'
                ]);
            }

        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }

    }

    /**
     * Subscription-cmas Api
     * @response 200{
     * "status": true,
     * "statusCode": 200,
     * "data": {
     *   "id": 1,
     *   "section1_title": "Experience Cinematic Magic Today! Subscribe to The Family Flix.",
     *   "section1_description": "Are you ready to embark on an unparalleled entertainment journey? Join The Family Flix community now and unlock a world of cinematic wonders!",
     *   "section1_background_img": "subscription/subscription-bg.png",
     *   "section1_button_name": "Sign Up Today",
     *   "subscribe_title": "Subscribe For Updates.",
     *   "subscription_placeholder": "Enter your Email",
     *   "button_name": "Subscribe",
     *   "created_at": "2024-03-15T10:11:44.000000Z",
     *   "updated_at": "2024-03-15T10:11:44.000000Z"
     * },
     * 
     */


    public function subscription(Request $request)
    {
        try{
            $subscription_cms = SubscribeCms::first();
            if(!$subscription_cms){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No Data Found'
                ]);
            }else{
                return response()->json([
                    'status' => true,
                    'statusCode' => 200,
                    'data' => $subscription_cms,
                    'message' => 'Subscription CMS data fetched successfully'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'statusCode' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }
}
