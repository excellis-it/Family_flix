<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;

class SubscriptionController extends Controller
{
    //
    public function customerSubscription()
    {
        $customer_subscriptions = UserSubscription::where('customer_id', auth()->user()->id)->orderBy('id', 'desc')->with('affiliate')->paginate(5);
        return view('customer.subscription.list', compact('customer_subscriptions'));
    }

    public function customerSubscriptionDetail($id)
    {
        $customer_subscription = UserSubscription::where('id', $id)->with('affiliate')->first();
        return view('customer.subscription.view', compact('customer_subscription'));
    }

    public function fetchSubscription(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $customer_subscriptions = UserSubscription::where('customer_details_id', auth()->user()->id)
                ->where(function($queryBuilder) use ($query) {
                    $queryBuilder->where('id', 'like', '%' . $query . '%')
                        ->orWhere('plan_name', 'like', '%' . $query . '%')
                        ->orWhere('plan_price', 'like', '%' . $query . '%')
                        ->orWhere('total', 'like', '%' . $query . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(5);

            return response()->json(['data' => view('customer.subscription.table', compact('customer_subscriptions'))->render()]);
        }
    }


    public function myFamilyCinema()
    {
        return view('customer.subscription.my-family-cinema');
    }
}
