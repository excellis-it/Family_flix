<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AffiliateCommission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommissionPercentageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        // page distinct percentage values
        $percentagesPage = AffiliateCommission::with('affiliate')->select('percentage')
            ->distinct()
            ->orderBy('percentage', 'desc') // change order as needed
            ->paginate(15);

        // load all commissions for the percentages on this page and group them
        $percentages = $percentagesPage->pluck('percentage')->toArray();

        $commissionsForPage = AffiliateCommission::with('affiliate')
            ->whereIn('percentage', $percentages)
            ->get()
            ->groupBy('percentage'); // collection keyed by percentage

        // we'll pass both: the paginated percentages (for links / counts) and grouped commissions
        return view('admin.commission_percentage.list', [
            'percentagesPage' => $percentagesPage,
            'commissionsForPage' => $commissionsForPage,
            'distinct_percentage_count' => AffiliateCommission::select('percentage')->distinct()->count(),
        ]);
    }

    public function fetchCommissionPercentage(Request $request)
    {
        if (! $request->ajax()) {
            abort(400);
        }

        $query = $request->get('query', '');
        $queryLike = '%' . str_replace(' ', '%', $query) . '%';

        // Find distinct percentages filtered by id or percentage or affiliate name
        // If you want to also search by affiliate name, join to affiliates
        $base = AffiliateCommission::query()
            ->leftJoin('affiliates', 'affiliate_commissions.affiliate_id', '=', 'affiliates.id')
            ->select('affiliate_commissions.percentage');

        if ($query) {
            $base->where(function ($q) use ($queryLike) {
                $q->where('affiliate_commissions.id', 'like', $queryLike)
                    ->orWhere('affiliate_commissions.percentage', 'like', $queryLike)
                    ->orWhere('affiliates.name', 'like', $queryLike);
            });
        }

        $percentagesPage = $base->distinct()
            ->orderBy('affiliate_commissions.percentage', 'desc')
            ->paginate(15);

        $percentages = $percentagesPage->pluck('percentage')->toArray();

        $commissionsForPage = AffiliateCommission::with('affiliate')
            ->whereIn('percentage', $percentages)
            ->get()
            ->groupBy('percentage');

        return response()->json([
            'data' => view('admin.commission_percentage.filter', compact('percentagesPage', 'commissionsForPage', 'distinct_percentage_count'))->render()
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $affiliaters =  User::role('AFFLIATE MARKETER')->orderBy('id', 'desc')->where('status', 1)->get();
        return view('admin.commission_percentage.create', compact('affiliaters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'percentage' => 'required',
            'affiliaters' => 'required'
        ]);
        if ($request->affiliaters) {
            foreach ($request->affiliaters as $affiliater) {
                $affiliate = User::find($affiliater);
                $affiliate->assignRole('AFFLIATE MARKETER');
                $affiliate_commission = new AffiliateCommission;
                $affiliate_commission->affiliate_id = $affiliater;
                $affiliate_commission->percentage = $request->percentage;
                $affiliate_commission->save();
            }
        }


        return redirect()->route('commission-percentage.index')->with('message', 'Commission Percentage Added Successfully');
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
        $affiliate_commission = AffiliateCommission::where('id', $id)->first();
        $commi_affiliaters = AffiliateCommission::where('percentage', $affiliate_commission->percentage)->get();
        $affiliaters =  User::role('AFFLIATE MARKETER')->orderBy('id', 'desc')->get();

        return view('admin.commission_percentage.edit', compact('affiliate_commission', 'affiliaters', 'commi_affiliaters'));
    }

    public function updatePercentage(Request $request)
    {
        $request->validate([
            'percentage' => 'required',
            'affiliaters' => 'required'
        ]);
        if ($request->affiliaters) {
            $delete_affiliater = AffiliateCommission::where('percentage', $request->percentage)->delete();
            foreach ($request->affiliaters as $affiliater) {
                $affiliate_commission = new AffiliateCommission;
                $affiliate_commission->affiliate_id = $affiliater;
                $affiliate_commission->percentage = $request->percentage;
                $affiliate_commission->save();
            }
        }


        return redirect()->route('commission-percentage.index')->with('message', 'Commission Percentage Updated Successfully');
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

    public function deletePercentage($id)
    {
        $commission = AffiliateCommission::where('id', $id)->first();
        $found_percentages = AffiliateCommission::where('percentage', $commission->percentage)->delete();

        return redirect()->route('commission-percentage.index')->with('message', 'Commission Percentage Deleted Successfully');
    }
}
