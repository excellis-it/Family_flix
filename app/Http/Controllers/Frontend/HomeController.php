<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCms;
use App\Models\Plan;
use App\Models\TopGrid;
use App\Models\OttService;
use App\Models\ContentTypeCms;
use App\Models\EntertainmentCms;
use App\Models\EntertainmentBanner;
use App\Models\SubscribeCms;
use App\Models\PlanCms;
use App\Models\AboutUs;
use App\Models\ContactUsCms;
use App\Models\ContactDetails;
use App\Models\SocialMedia;
use App\Models\ContactUs;
use App\Models\SubscriptionUs;
use App\Models\BusinessManagement;
use App\Models\Product;
use App\Models\Faq;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    //
    public function home()
    {
        $home_cms = HomeCms::first();
        $top_grids = TopGrid::orderBy('id', 'asc')->get();
        $ott_icons = OttService::orderBy('id', 'asc')->get();
        $entertainments = EntertainmentCms::orderBy('id', 'asc')->get();
        $plan_list = Plan::orderBy('plan_order', 'asc')->with('Specification')->get();
        $products = Product::orderBy('id', 'asc')->where('unbeatable_status', 1)->get();

        return view('frontend.pages.home', compact('home_cms', 'plan_list', 'top_grids', 'ott_icons', 'entertainments', 'products'));
    }


    public function aboutUs()
    {
        $about_cms = AboutUs::first();
        $home_cms = HomeCms::first();
        $top_grids = TopGrid::orderBy('id', 'asc')->get();
        $entertainments = EntertainmentCms::orderBy('id', 'asc')->get();
        return view('frontend.pages.about', compact('about_cms', 'top_grids', 'home_cms', 'entertainments'));
    }

    public function movies()
    {
        $top_10_shows = Product::where('top_10_status', 1)->where('type', 'movie')->get();
        $popular_shows = Product::where('popular_status', 1)->where('type', 'movie')->get();
        $movie_cms = ContentTypeCms::where('type', 'movie')->first();
        $entertainments_banners = EntertainmentBanner::where('banner_type', 'Movies')->get();
        $subscriptions = SubscribeCms::first();
        return view('frontend.pages.movies', compact('movie_cms', 'entertainments_banners', 'subscriptions', 'top_10_shows', 'popular_shows'));
    }

    public function shows()
    {
        $top_10_shows = Product::where('top_10_status', 1)->where('type', 'shows')->get();
        $popular_shows = Product::where('popular_status', 1)->where('type', 'shows')->get();
        $show_cms = ContentTypeCms::where('type', 'show')->first();
        $entertainments_banners = EntertainmentBanner::where('banner_type', 'Shows')->get();
        $subscriptions = SubscribeCms::first();
        return view('frontend.pages.shows', compact('show_cms', 'entertainments_banners', 'subscriptions', 'top_10_shows', 'popular_shows'));
    }

    public function kids()
    {
        $top_10_shows = Product::where('top_10_status', 1)->where('type', 'kids')->get();
        $popular_shows = Product::where('popular_status', 1)->where('type', 'kids')->get();
        $kid_cms = ContentTypeCms::where('type', 'kid')->first();
        $entertainments_banners = EntertainmentBanner::where('banner_type', 'Kids')->get();
        $subscriptions = SubscribeCms::first();
        return view('frontend.pages.kids', compact('entertainments_banners', 'subscriptions', 'kid_cms', 'top_10_shows', 'popular_shows'));
    }

    public function pricing($id = null)
    {

        $plan_cms = PlanCms::first();
        $home_cms = HomeCms::first();
        $products = Product::orderBy('id', 'desc')->where('unbeatable_status', 1)->get();
        $plan_list = Plan::orderBy('plan_order', 'asc')->with('Specification')->get();
        $entertainments = EntertainmentCms::orderBy('id', 'asc')->get();

        if ($id != null) {
            $id = decrypt($id);
            session()->put('affiliate_id', $id);
        }

        return view('frontend.pages.pricing', compact('plan_cms', 'plan_list', 'home_cms', 'entertainments', 'products'));
    }

    public function contactUs()
    {
        $contact_cms = ContactUsCms::first();
        $contact_details = ContactDetails::get();
        $social_icons = SocialMedia::orderBy('id', 'desc')->get();
        return view('frontend.pages.contact', compact('contact_cms', 'contact_details', 'social_icons'));
    }

    public function contactSubmit(Request $request)
    {
        $contact_submit = new ContactUs();
        $contact_submit->user_name = $request->user_name;
        $contact_submit->user_email = $request->user_email;
        $contact_submit->user_phone = $request->user_number;
        $contact_submit->message = $request->user_message;
        $contact_submit->save();

        return back()->with('message', 'Thank you for contacting us.');
    }

    public function subscriptionSubmit(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email:rfc,dns|max:255',
        ], [
            'user_email.required' => 'Please enter your email address.',
            'user_email.email'    => 'Please enter a valid email address.',
            'user_email.max'      => 'Email cannot be longer than 255 characters.',
        ]);
        $check_mail = SubscriptionUs::where('email', $request->user_email)->count();
        if ($check_mail > 0) {
            return back()->with('error', 'This email address is already subscribed.');
        }
        $subscription_submit = new SubscriptionUs();
        $subscription_submit->email = $request->user_email;
        $subscription_submit->save();

        return back()->with('message', 'Thank you for subscribing us');
    }

    public function faqs()
    {
        $faq = BusinessManagement::where('type', 'faq')->first();
        $faq_qstn_ansrs = Faq::where('type', 'general')->orderBy('id', 'asc')->get();
        return view('frontend.pages.faqs', compact('faq', 'faq_qstn_ansrs'));
    }

    public function termService()
    {
        $terms = BusinessManagement::where('type', 'term-condition')->first();
        return view('frontend.pages.term-service', compact('terms'));
    }

    public function privacyPolicy()
    {
        $privacy = BusinessManagement::where('type', 'privacy-policy')->first();
        return view('frontend.pages.privacy-policy', compact('privacy'));
    }
}
