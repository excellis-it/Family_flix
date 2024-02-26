<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessManagement;
use App\Models\AffiliateCommission;

class BusinessManagementController extends Controller
{
    //

    public function faq()
    {
        $faq = BusinessManagement::where('type','faq')->first();
        return view('admin.business_management.faq',compact('faq'));
    }

    public function faqUpdate(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required',
            'content' => 'required',
        ]);

        $faq_update = BusinessManagement::where('id',$request->id)->first();
        $faq_update->banner_heading = $request->banner_heading; 
        $faq_update->content = $request->content;
        
        if ($request->hasFile('banner_image')) {
            $request->validate([
                'banner_image' => 'required',
            ]);
            
            $file04= $request->file('banner_image');
            $filename04= date('YmdHi').$file04->getClientOriginalName();
            $image_path04 = $request->file('banner_image')->store('business_management', 'public');
            $faq_update->banner_image = $image_path04;
        }

        $faq_update->update();

        return back()->with('message','Faq updated successfully');

    }

    public function privacy()
    {
        $privacy = BusinessManagement::where('type','privacy-policy')->first();
        return view('admin.business_management.privacy',compact('privacy'));
    }

    public function privacyUpdate(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required',
            'content' => 'required',
        ]);

        $privacy_update = BusinessManagement::where('id',$request->id)->first();
        $privacy_update->banner_heading = $request->banner_heading; 
        $privacy_update->content = $request->content;
        
        if ($request->hasFile('banner_image')) {
            $request->validate([
                'banner_image' => 'required',
            ]);
            
            $file04= $request->file('banner_image');
            $filename04= date('YmdHi').$file04->getClientOriginalName();
            $image_path04 = $request->file('banner_image')->store('business_management', 'public');
            $privacy_update->banner_image = $image_path04;
        }

        $privacy_update->update();

        return back()->with('message','Privacy updated successfully');
    }


    public function terms()
    {
        $terms = BusinessManagement::where('type','term-condition')->first();
        return view('admin.business_management.term',compact('terms'));
    }

    public function termsUpdate(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required',
            'content' => 'required',
        ]);

        $terms_update = BusinessManagement::where('id',$request->id)->first();
        $terms_update->banner_heading = $request->banner_heading; 
        $terms_update->content = $request->content;
        
        if ($request->hasFile('banner_image')) {
            $request->validate([
                'banner_image' => 'required',
            ]);
            
            $file04= $request->file('banner_image');
            $filename04= date('YmdHi').$file04->getClientOriginalName();
            $image_path04 = $request->file('banner_image')->store('business_management', 'public');
            $terms_update->banner_image = $image_path04;
        }

        $terms_update->update();

        return back()->with('message','Terms updated successfully');
    }

    public function commissionPercentage()
    {
        $commission = AffiliateCommission::first();
        return view('admin.affiliate_commission.view',compact('commission'));
    }

    public function updateCommissionPercentage(Request $request)
    {
        $request->validate([
            'percentage' => 'required',
        ]);

        $commission = AffiliateCommission::where('id',$request->id)->first();
        $commission->percentage = $request->percentage;
        $commission->update();

        return back()->with('message','Commission updated successfully');
    }
}
