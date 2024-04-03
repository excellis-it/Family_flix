<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    //

    public function contactList()
    { 
        $contactUs = ContactUs::orderBy('id','desc')->paginate(15);
        return view('admin.contact.list',compact('contactUs'));
    }

    public function contactAjaxList(Request $request)
    {  
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $contactUs = ContactUs::where('id', 'like', '%' . $query . '%')
                    ->orWhere('user_name', 'like', '%' . $query . '%')
                    ->orWhere('user_email', 'like', '%' . $query . '%')
                    ->orWhere('user_phone', 'like', '%' . $query . '%')
                    ->orWhere('message', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.contact.filter', compact('contactUs'))->render()]);
        }
    }


}
