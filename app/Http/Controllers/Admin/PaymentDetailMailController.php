<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentDetailMail;

class PaymentDetailMailController extends Controller
{
    //

    public function paymentDetailMail()
    {
        $payment_detail_mail = PaymentDetailMail::where('status',1)->first();
        return view('admin.site_settings.payment_detail.edit', compact('payment_detail_mail'));
    }

    public function paymentDetailMailUpdate(Request $request)
    {
        // validation
        $request->validate([
            'email' => 'required|email',
        ]);

        $payment_detail_mail = PaymentDetailMail::where('status',1)->first();
        $payment_detail_mail->email = $request->email;
        $payment_detail_mail->status = $request->status;
        $payment_detail_mail->save();

        return redirect()->back()->with('message', 'Payment Detail Mail Updated Successfully');
    }
}
