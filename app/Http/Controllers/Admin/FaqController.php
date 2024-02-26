<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\BusinessManagement;

class FaqController extends Controller
{
    //

    public function faqPayment()
    {
        $payments_faqs = Faq::where('type', 'payment')->get();
        $faq_cms = BusinessManagement::where('type', 'faq')->first();
        return view('admin.faq.payment',compact('payments_faqs','faq_cms'));
    }


    public function faqPaymentUpdate(Request $request)
    {
        //validation 
        $request->validate([
            'title' => 'required',
        ]);
        $faq_cms = BusinessManagement::where('id', $request->faq_cms_id)->first();
        $faq_cms->banner_heading = $request->title;
        $faq_cms->update();

        //payment faq question answer update
        if ($request->question) {
           
            $delete_payment_faq = Faq::where('type','payment')->delete();
            foreach ($request->question as $keys => $question) {
                if ($question !='') {
                    $payment_faq = new Faq();
                    $payment_faq->type = 'payment'; 
                    $payment_faq->question = $request->question[$keys];
                    $payment_faq->answer = $request->answer[$keys];
                    $payment_faq->save();
                } 
            }
        }

        return redirect()->back()->with('message', 'Payment Page Faq Updated Successfully');
    }

    public function faqGeneral()
    {
        $general_faqs = Faq::where('type', 'general')->get();
        $faq_cms = BusinessManagement::where('type', 'faq')->first();
        return view('admin.faq.general',compact('general_faqs','faq_cms'));
    }

    public function faqGeneralUpdate(Request $request)
    {
       
        //validation 
        $request->validate([
            'title' => 'required',
        ]);
        $faq_cms = BusinessManagement::where('id', $request->faq_cms_id)->first();
        $faq_cms->banner_heading = $request->title;
        //image upload
        if ($request->hasFile('banner_image')) {
            $request->validate([
                'banner_image' => 'required',
            ]);
            
            $file11= $request->file('banner_image');
            $filename11= date('YmdHi').$file11->getClientOriginalName();
            $image_path11 = $request->file('banner_image')->store('business_management', 'public');
            $faq_cms->banner_image = $image_path11;
        }
        $faq_cms->update();

        //general faq question answer update
        if ($request->question) {
           
            $delete_general_faq = Faq::where('type','general')->delete();
            foreach ($request->question as $keys => $question) {
                if ($question !='') {
                    $general_faq = new Faq();
                    $general_faq->type = 'general'; 
                    $general_faq->question = $request->question[$keys];
                    $general_faq->answer = $request->answer[$keys];
                    $general_faq->save();
                } 
            }
        }

        return redirect()->back()->with('message', 'General Page Faq Updated Successfully');
    }
}
