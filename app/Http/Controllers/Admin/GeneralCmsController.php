<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanCms;
use App\Models\ContactUsCms;
use App\Models\ContentTypeCms;
use App\Models\TopGrid;
use Illuminate\Support\Facades\Auth;


class GeneralCmsController extends Controller
{
    //

    public function planCms()
    {
        $plan_cms = PlanCms::first();
        return View('admin.cms.plan', compact('plan_cms'));
    }

    public function planCmsUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'main_title' => 'required',
            'middle_content' => 'required',
            'title1' => 'required',
            'description1' => 'required',
            'title2' => 'required',
            'description2' => 'required',

        ]);

        $plan_cms = PlanCms::where('id', $request->id)->first();
        $plan_cms->title = $request->title;
        $plan_cms->short_description = $request->short_description;
        $plan_cms->main_title = $request->main_title;
        $plan_cms->middle_content = $request->middle_content;
        $plan_cms->title1 = $request->title1;
        $plan_cms->description1 = $request->description1;
        $plan_cms->title2 = $request->title2;
        $plan_cms->description2 = $request->description2;

        //banner image upload
        if ($request->hasFile('banner_img')) {
            $request->validate([
                'banner_img' => 'required',
            ]);

            $file = $request->file('banner_img');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $image_path = $request->file('banner_img')->store('plan', 'public');
            $plan_cms->banner_img = $image_path;
        }

        //background image upload
        if ($request->hasFile('background_img')) {
            $request->validate([
                'background_img' => 'required',
            ]);

            $file1 = $request->file('background_img');
            $filename1 = date('YmdHi') . $file1->getClientOriginalName();
            $image_path1 = $request->file('background_img')->store('plan', 'public');
            $plan_cms->background_img = $image_path1;
        }

        //middle background image upload
        if ($request->hasFile('middle_back_img')) {
            $request->validate([
                'middle_back_img' => 'required',
            ]);

            $file11 = $request->file('middle_back_img');
            $filename11 = date('YmdHi') . $file11->getClientOriginalName();
            $image_path11 = $request->file('middle_back_img')->store('plan', 'public');
            $plan_cms->middle_back_img = $image_path11;
        }

        //anime1_img upload
        if ($request->hasFile('anime1_img')) {
            $request->validate([
                'anime1_img' => 'required',
            ]);

            $file12 = $request->file('anime1_img');
            $filename12 = date('YmdHi') . $file12->getClientOriginalName();
            $image_path12 = $request->file('anime1_img')->store('plan', 'public');
            $plan_cms->anime1_img = $image_path12;
        }

        //anime2_img upload
        if ($request->hasFile('anime2_img')) {
            $request->validate([
                'anime2_img' => 'required',
            ]);

            $file13 = $request->file('anime2_img');
            $filename13 = date('YmdHi') . $file13->getClientOriginalName();
            $image_path13 = $request->file('anime2_img')->store('plan', 'public');
            $plan_cms->anime2_img = $image_path13;
        }
        $plan_cms->update();

        return back()->with('message', 'Plan cms updated successfully');
    }

    public function kidCms()
    {
        $kid_cms =  ContentTypeCms::where('type', 'kid')->first();
        return View('admin.cms.kids', compact('kid_cms'));
    }

    public function kidCmsUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'small_description' => 'required',
        ]);

        $kid_cms = ContentTypeCms::where('id', $request->id)->where('type', 'kid')->first();
        $kid_cms->heading = $request->heading;
        $kid_cms->small_description = $request->small_description;
         $kid_cms->meta_title = $request->meta_title;
        $kid_cms->meta_keyword = $request->meta_keyword;
        $kid_cms->meta_description = $request->meta_description;

        //banner_img upload
        if ($request->hasFile('banner_img')) {
            $request->validate([
                'banner_img' => 'required',
            ]);

            $file13 = $request->file('banner_img');
            $filename13 = date('YmdHi') . $file13->getClientOriginalName();
            $image_path13 = $request->file('banner_img')->store('kids', 'public');
            $kid_cms->banner_img = $image_path13;
        }

        //top_10_show_background upload
        if ($request->hasFile('top_10_show_background')) {
            $request->validate([
                'top_10_show_background' => 'required',
            ]);

            $file14 = $request->file('top_10_show_background');
            $filename14 = date('YmdHi') . $file14->getClientOriginalName();
            $image_path14 = $request->file('top_10_show_background')->store('kids', 'public');
            $kid_cms->top_10_show_background = $image_path14;
        }

        // popular_show_background upload
        if ($request->hasFile('popular_show_background')) {
            $request->validate([
                'popular_show_background' => 'required',
            ]);

            $file15 = $request->file('popular_show_background');
            $filename15 = date('YmdHi') . $file15->getClientOriginalName();
            $image_path15 = $request->file('popular_show_background')->store('kids', 'public');
            $kid_cms->popular_show_background = $image_path15;
        }

        $kid_cms->update();

        return back()->with('message', 'Kid cms updated successfully');
    }

    public function showCms()
    {
        $show_cms = ContentTypeCms::where('type', 'show')->first();
        return view('admin.cms.show', compact('show_cms'));
    }

    public function showCmsUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'small_description' => 'required',
        ]);

        $show_cms = ContentTypeCms::where('id', $request->id)->where('type', 'show')->first();
        $show_cms->heading = $request->heading;
        $show_cms->small_description = $request->small_description;

        $show_cms->meta_title = $request->meta_title;
        $show_cms->meta_keyword = $request->meta_keyword;
        $show_cms->meta_description = $request->meta_description;
        //banner_img upload
        if ($request->hasFile('banner_img')) {
            $request->validate([
                'banner_img' => 'required',
            ]);

            $file13 = $request->file('banner_img');
            $filename13 = date('YmdHi') . $file13->getClientOriginalName();
            $image_path13 = $request->file('banner_img')->store('kids', 'public');
            $show_cms->banner_img = $image_path13;
        }

        //top_10_show_background upload
        if ($request->hasFile('top_10_show_background')) {
            $request->validate([
                'top_10_show_background' => 'required',
            ]);

            $file14 = $request->file('top_10_show_background');
            $filename14 = date('YmdHi') . $file14->getClientOriginalName();
            $image_path14 = $request->file('top_10_show_background')->store('kids', 'public');
            $show_cms->top_10_show_background = $image_path14;
        }

        // popular_show_background upload

        if ($request->hasFile('popular_show_background')) {
            $request->validate([
                'popular_show_background' => 'required',
            ]);

            $file15 = $request->file('popular_show_background');
            $filename15 = date('YmdHi') . $file15->getClientOriginalName();
            $image_path15 = $request->file('popular_show_background')->store('kids', 'public');
            $show_cms->popular_show_background = $image_path15;
        }

        $show_cms->update();

        return back()->with('message', 'Show cms updated successfully');
    }

    public function movieCms()
    {
        $movie_cms = ContentTypeCms::where('type', 'movie')->first();
        return view('admin.cms.movie', compact('movie_cms'));
    }

    public function movieCmsUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'small_description' => 'required',
        ]);

        $movie_cms = ContentTypeCms::where('id', $request->id)->where('type', 'movie')->first();
        $movie_cms->heading = $request->heading;
        $movie_cms->small_description = $request->small_description;
         $movie_cms->meta_title = $request->meta_title;
        $movie_cms->meta_keyword = $request->meta_keyword;
        $movie_cms->meta_description = $request->meta_description;

        //banner_img upload
        if ($request->hasFile('banner_img')) {
            $request->validate([
                'banner_img' => 'required',
            ]);

            $file13 = $request->file('banner_img');
            $filename13 = date('YmdHi') . $file13->getClientOriginalName();
            $image_path13 = $request->file('banner_img')->store('movie', 'public');
            $movie_cms->banner_img = $image_path13;
        }

        //top_10_show_background upload
        if ($request->hasFile('top_10_show_background')) {
            $request->validate([
                'top_10_show_background' => 'required',
            ]);

            $file14 = $request->file('top_10_show_background');
            $filename14 = date('YmdHi') . $file14->getClientOriginalName();
            $image_path14 = $request->file('top_10_show_background')->store('movie', 'public');
            $movie_cms->top_10_show_background = $image_path14;
        }

        // popular_show_background upload

        if ($request->hasFile('popular_show_background')) {
            $request->validate([
                'popular_show_background' => 'required',
            ]);

            $file15 = $request->file('popular_show_background');
            $filename15 = date('YmdHi') . $file15->getClientOriginalName();
            $image_path15 = $request->file('popular_show_background')->store('movie', 'public');
            $movie_cms->popular_show_background = $image_path15;
        }

        $movie_cms->update();

        return back()->with('message', 'Movie cms updated successfully');
    }

    public function contactCms()
    {
        $contact_cms = ContactUsCms::first();
        return view('admin.cms.contact-us', compact('contact_cms'));
    }

    public function contactCmsUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'main_title' => 'required',
            'short_title' => 'required',
            'button_name' => 'required',
            'map_link' => 'required',
        ]);

        $contact_cms = ContactUsCms::where('id', $request->id)->first();
        $contact_cms->title = $request->title;
        $contact_cms->main_title = $request->main_title;
        $contact_cms->short_title = $request->short_title;
        $contact_cms->button_name = $request->button_name;
        $contact_cms->map_link = $request->map_link;

        if ($request->hasFile('banner_img')) {
            $request->validate([
                'banner_img' => 'required',
            ]);

            $file15 = $request->file('banner_img');
            $filename15 = date('YmdHi') . $file15->getClientOriginalName();
            $image_path15 = $request->file('banner_img')->store('contact', 'public');
            $contact_cms->banner_img = $image_path15;
        }


        if ($request->hasFile('background_img')) {
            $request->validate([
                'background_img' => 'required',
            ]);

            $file11 = $request->file('background_img');
            $filename11 = date('YmdHi') . $file11->getClientOriginalName();
            $image_path11 = $request->file('background_img')->store('contact', 'public');
            $contact_cms->background_img = $image_path11;
        }


        $contact_cms->update();

        return back()->with('message', 'Contact cms updated successfully');
    }
}
