<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    //

    public function contactList()
    {
        $contact_list = ContactUs::orderBy('id','desc')->get();
        return view('admin.contact.list',compact('contact_list'));
    }
}
