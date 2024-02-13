<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use App\Models\AboutUs;
use App\Models\HomeCms;
use App\Models\TopGrid;
use App\Models\OttService;
use App\Models\EntertainmentCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    
    public function homeCms()
    {
        $home_cms = HomeCms::first();
        $top_grids = TopGrid::orderBy('id', 'desc')->get();
        $ott_icons = OttService::orderBy('id', 'desc')->get();
        $entertainments = EntertainmentCms::orderBy('id', 'desc')->get();
        return view('admin.cms.home', compact('home_cms','top_grids','ott_icons','entertainments'));
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
            'entertainment_title' => 'required',
            'entertainment_description' => 'required',

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
        $home_cms->entertainment_title = $request->entertainment_title;
        $home_cms->entertainment_description = $request->entertainment_description;
        
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


        //multiple grid icon upload
        if ($request->hasFile('grid_icon')) {
            
            foreach ($request->file('grid_icon') as $key => $file) {
                if ($file->isValid()) {
                    $file_path = $file->store('grid', 'public'); 
        
                    $top_grid = new TopGrid();
                    $top_grid->icon = $file_path; 
                    $top_grid->title = $request->grid_title[$key];
                    $top_grid->description = $request->grid_description[$key];
                    $top_grid->save();
                } 
            }
        }
        
        //multiple ott icon upload
        if ($request->hasFile('ott_icon')) {
            
            foreach ($request->file('ott_icon') as $key => $file) {
                if ($file->isValid()) {
                    $file_path = $file->store('ott_icon', 'public'); 
        
                    $ott_service = new OttService();
                    $ott_service->icon = $file_path; 
                    $ott_service->save();
                } 
            }
        }


        // multiple entertainment imge and image name upload
        if ($request->hasFile('entern_image')) {
            
            foreach ($request->file('entern_image') as $key => $file1) {
                if ($file1->isValid()) {
                    $file_path1 = $file1->store('entertainment', 'public'); 
        
                    $entertainment_add = new EntertainmentCms();
                    $entertainment_add->image = $file_path1; 
                    $entertainment_add->image_name = $request->image_name[$key];
                    $entertainment_add->save();
                } 
            }
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

    public function entertainmentCms()
    {
        $entertainment_cms = EntertainmentCms::first();
        $entertainments = EntertainmentCms::orderBy('id', 'desc')->get();
        return view('admin.cms.entertainment',compact('entertainment_cms','entertainments'));
    }


   
}
