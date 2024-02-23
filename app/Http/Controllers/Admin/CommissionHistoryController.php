<?php

namespace App\Http\Controllers\Admin;

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
        $commissions = UserSubscription::orderBy('id', 'desc')->paginate(15);
        return view('admin.commission-history.list', compact('commissions'));
    }

    public function fetchData(Request $request)
    {
        if ($request->ajax()) {
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
                ->orWhereHas('affiliate', function ($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('affiliate', function ($q) use ($query) {
                    $q->where('email', 'like', '%' . $query . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(15);

            return response()->json(['data' => view('admin.commission-history.filter', compact('commissions'))->render()]);
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
        $commission = UserSubscription::find($id);
        return view('admin.commission-history.view', compact('commission'));
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
