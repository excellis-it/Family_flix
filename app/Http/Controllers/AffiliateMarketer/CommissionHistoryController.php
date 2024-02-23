<?php

namespace App\Http\Controllers\AffiliateMarketer;

use App\Http\Controllers\Controller;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class CommissionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = UserSubscription::where('affiliate_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(15);
        return view('frontend.affiliate-marketer.commission-history.list', compact('commissions'));
    }

    public function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $commissions = UserSubscription::where('id', 'like', '%' . $query . '%')
                ->orWhere('plan_name', 'like', '%' . $query . '%')
                ->orWhere('plan_price', 'like', '%' . $query . '%')
                ->orWhere('affiliate_commission', 'like', '%' . $query . '%')
                ->orWhere('total', 'like', '%' . $query . '%')
                ->orWhereHas('customerDetails', function ($q) use ($query) {
                    $q->whereRaw("CONCAT(first_name, ' ', last_name) like '%" . $query . "%'");
                })
                ->orWhereHas('customerDetails', function ($q) use ($query) {
                    $q->where('email_address', 'like', '%' . $query . '%');
                })
                ->where('affiliate_id', auth()->user()->id)
                ->orderBy('id', 'desc')
                ->paginate(15);

            return response()->json(['data' => view('frontend.affiliate-marketer.commission-history.filter', compact('commissions'))->render()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
