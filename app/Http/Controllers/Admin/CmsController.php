<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use App\Models\AboutUs;
use App\Models\HomeCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    
    public function homeCms()
    {
        $home_cms = HomeCms::first();
        return view('admin.cms.home', compact('home_cms'));
    }
   
    public function homeCmsUpdate(Request $request)
    {
        
        $request->validate([
            'top_short_title' => 'required',
            'top_main_title' => 'required',
            'top_button_text' => 'required',
            'section2_title' => 'required',
            'section2_description' => 'required',
            'section2_short_title' => 'required',
            'section3_title' => 'required',
            'section3_video_link' => 'required',
            'section4_title' => 'required',
            'section4_description' => 'required',
            'section5_main_title' => 'required',
            'section5_main_description' => 'required',
            'plan_section_title' => 'required',
        ]);

        $home_cms = HomeCms::where('id', $request->id)->first();
        $home_cms->top_short_title = $request->top_short_title;
        $home_cms->top_main_title = $request->top_main_title;
        $home_cms->top_button_text = $request->top_button_text;
        $home_cms->section2_title = $request->section2_title;
        $home_cms->section2_description = $request->section2_description;
        $home_cms->section2_short_title = $request->section2_short_title;
        $home_cms->section3_title = $request->section3_title;
        $home_cms->section3_video_link = $request->section3_video_link;
        $home_cms->section4_title = $request->section4_title;
        $home_cms->section4_description = $request->section4_description;
        $home_cms->section5_main_title = $request->section5_main_title;
        $home_cms->section5_main_description = $request->section5_main_description;
        $home_cms->plan_section_title = $request->plan_section_title;
        
        //top back image upload

        if ($request->hasFile('top_back_image')) {
            $request->validate([
                'top_back_image' => 'required',
            ]);
            
            $file= $request->file('top_back_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $image_path = $request->file('top_back_image')->store('home', 'public');
            $home_cms->top_back_image = $image_path;
        }

        //section1 main image upload

        if ($request->hasFile('section1_main_image')) {
            $request->validate([
                'section1_main_image' => 'required',
            ]);
            
            $file1= $request->file('section1_main_image');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('section1_main_image')->store('home', 'public');
            $home_cms->section1_main_image = $image_path1;
        }

        //section1 back image upload
        if ($request->hasFile('section1_back_image')) {
            $request->validate([
                'section1_back_image' => 'required',
            ]);
            
            $file2= $request->file('section1_back_image');
            $filename2= date('YmdHi').$file2->getClientOriginalName();
            $image_path2 = $request->file('section1_back_image')->store('home', 'public');
            $home_cms->section1_back_image = $image_path2;
        }

        //section2 main image upload

        if ($request->hasFile('section2_main_image')) {
            $request->validate([
                'section2_main_image' => 'required',
            ]);
            
            $file3= $request->file('section2_main_image');
            $filename3= date('YmdHi').$file3->getClientOriginalName();
            $image_path3 = $request->file('section2_main_image')->store('home', 'public');
            $home_cms->section2_main_image = $image_path3;
        }

        // section2_back_image upload
        if ($request->hasFile('section2_back_image')) {
            $request->validate([
                'section2_back_image' => 'required',
            ]);
            
            $file4= $request->file('section2_back_image');
            $filename4= date('YmdHi').$file4->getClientOriginalName();
            $image_path4 = $request->file('section2_back_image')->store('home', 'public');
            $home_cms->section2_back_image = $image_path4;
        }

        //section2_main_icon upload
        if ($request->hasFile('section2_main_icon')) {
            $request->validate([
                'section2_main_icon' => 'required',
            ]);
            
            $file5= $request->file('section2_main_icon');
            $filename5= date('YmdHi').$file5->getClientOriginalName();
            $image_path5 = $request->file('section2_main_icon')->store('home', 'public');
            $home_cms->section2_main_icon = $image_path5;
        }

        //section2_icon1 upload
        if ($request->hasFile('section2_icon1')) {
            $request->validate([
                'section2_icon1' => 'required',
            ]);
            
            $file6= $request->file('section2_icon1');
            $filename6= date('YmdHi').$file6->getClientOriginalName();
            $image_path6 = $request->file('section2_icon1')->store('home', 'public');
            $home_cms->section2_icon1 = $image_path6;
        }


        //section2_icon2 upload
        if ($request->hasFile('section2_icon2')) {
            $request->validate([
                'section2_icon2' => 'required',
            ]);
            
            $file7= $request->file('section2_icon2');
            $filename7= date('YmdHi').$file7->getClientOriginalName();
            $image_path7 = $request->file('section2_icon2')->store('home', 'public');
            $home_cms->section2_icon2 = $image_path7;
        }

        //section2_icon3 upload
        if ($request->hasFile('section2_icon3')) {
            $request->validate([
                'section2_icon3' => 'required',
            ]);
            
            $file8= $request->file('section2_icon3');
            $filename8= date('YmdHi').$file8->getClientOriginalName();
            $image_path8 = $request->file('section2_icon3')->store('home', 'public');
            $home_cms->section2_icon3 = $image_path8;
        }

        //section2_icon4 upload
        if ($request->hasFile('section2_icon4')) {
            $request->validate([
                'section2_icon4' => 'required',
            ]);
            
            $file9= $request->file('section2_icon4');
            $filename9= date('YmdHi').$file9->getClientOriginalName();
            $image_path9 = $request->file('section2_icon4')->store('home', 'public');
            $home_cms->section2_icon4 = $image_path9;
        }

        //section2_icon5 upload
        if ($request->hasFile('section2_icon5')) {
            $request->validate([
                'section2_icon5' => 'required',
            ]);
            
            $file10= $request->file('section2_icon5');
            $filename10= date('YmdHi').$file10->getClientOriginalName();
            $image_path10 = $request->file('section2_icon5')->store('home', 'public');
            $home_cms->section2_icon5 = $image_path10;
        }


        //section2_icon6 upload
        if ($request->hasFile('section2_icon6')) {
            $request->validate([
                'section2_icon6' => 'required',
            ]);
            
            $file11= $request->file('section2_icon6');
            $filename11= date('YmdHi').$file11->getClientOriginalName();
            $image_path11 = $request->file('section2_icon6')->store('home', 'public');
            $home_cms->section2_icon6 = $image_path11;
        }

        //section2_icon7 upload
        if ($request->hasFile('section2_icon7')) {
            $request->validate([
                'section2_icon7' => 'required',
            ]);
            
            $file12= $request->file('section2_icon7');
            $filename12= date('YmdHi').$file12->getClientOriginalName();
            $image_path12 = $request->file('section2_icon7')->store('home', 'public');
            $home_cms->section2_icon7 = $image_path12;
        }

        //section2_icon8 upload

        if ($request->hasFile('section2_icon8')) {
            $request->validate([
                'section2_icon8' => 'required',
            ]);
            
            $file13= $request->file('section2_icon8');
            $filename13= date('YmdHi').$file13->getClientOriginalName();
            $image_path13 = $request->file('section2_icon8')->store('home', 'public');
            $home_cms->section2_icon8 = $image_path13;
        }

        //section3_back_image upload
        if ($request->hasFile('section3_back_image')) {
            $request->validate([
                'section3_back_image' => 'required',
            ]);
            
            $file14= $request->file('section3_back_image');
            $filename14= date('YmdHi').$file14->getClientOriginalName();
            $image_path14 = $request->file('section3_back_image')->store('home', 'public');
            $home_cms->section3_back_image = $image_path14;
        }
       
        //section3_main_image upload
        if ($request->hasFile('section3_main_image')) {
            $request->validate([
                'section3_main_image' => 'required',
            ]);
            
            $file15= $request->file('section3_main_image');
            $filename15= date('YmdHi').$file15->getClientOriginalName();
            $image_path15 = $request->file('section3_main_image')->store('home', 'public');
            $home_cms->section3_main_image = $image_path15;
        }

        //section4_back_image upload

        if ($request->hasFile('section4_back_image')) {
            $request->validate([
                'section4_back_image' => 'required',
            ]);
            
            $file16= $request->file('section4_back_image');
            $filename16= date('YmdHi').$file16->getClientOriginalName();
            $image_path16 = $request->file('section4_back_image')->store('home', 'public');
            $home_cms->section4_back_image = $image_path16;
        }

        //section5_back_image upload

        if ($request->hasFile('section5_back_image')) {
            $request->validate([
                'section5_back_image' => 'required',
            ]);
            
            $file17= $request->file('section5_back_image');
            $filename17= date('YmdHi').$file17->getClientOriginalName();
            $image_path17 = $request->file('section5_back_image')->store('home', 'public');
            $home_cms->section5_back_image = $image_path17;
        }

        //section5_main_image upload
        if ($request->hasFile('section5_main_image')) {
            $request->validate([
                'section5_main_image' => 'required',
            ]);
            
            $file18= $request->file('section5_main_image');
            $filename18= date('YmdHi').$file18->getClientOriginalName();
            $image_path18 = $request->file('section5_main_image')->store('home', 'public');
            $home_cms->section5_main_image = $image_path18;
        }


        //plan_section_back_image upload

        if ($request->hasFile('plan_section_back_image')) {
            $request->validate([
                'plan_section_back_image' => 'required',
            ]);
            
            $file19= $request->file('plan_section_back_image');
            $filename19= date('YmdHi').$file19->getClientOriginalName();
            $image_path19 = $request->file('plan_section_back_image')->store('home', 'public');
            $home_cms->plan_section_back_image = $image_path19;
        }

        $home_cms->update();
        return redirect()->back()->with('message', 'Home Created Successfully');
    }

   
}
