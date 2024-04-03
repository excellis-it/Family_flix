<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionUs;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    //

    public function subscriptionList()
    {
        $subscriptions = SubscriptionUs::orderBy('id','desc')->paginate(15);
        return view('admin.subscribers.list',compact('subscriptions'));
    }

    public function subscriptionAjaxList(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $subscriptions = SubscriptionUs::where('id', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.subscribers.filter', compact('subscriptions'))->render()]);
        }
    }
}
