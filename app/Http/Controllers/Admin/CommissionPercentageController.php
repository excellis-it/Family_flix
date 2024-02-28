<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AffiliateCommission;
use App\Models\User;

class CommissionPercentageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
        $commission_percentages = AffiliateCommission::all();
        $commission_percentages = $commission_percentages->unique('percentage');
        return view('admin.commission_percentage.list',compact('commission_percentages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $affiliaters =  User::role('AFFLIATE MARKETER')->orderBy('id', 'desc')->get();
        return view('admin.commission_percentage.create',compact('affiliaters'));
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
        if($request->affiliaters){
            foreach($request->affiliaters as $affiliater){
                $affiliate = User::find($affiliater);
                $affiliate->assignRole('AFFLIATE MARKETER');
                $affiliate_commission = new AffiliateCommission;
                $affiliate_commission->affiliate_id = $affiliater;
                $affiliate_commission->percentage = $request->percentage;
                $affiliate_commission->save();
            }
        }

        
        return redirect()->route('commission-percentage.index')->with('message','Commission Percentage Added Successfully');
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
        $affiliate_commission = AffiliateCommission::where('id',$id)->first();
        $commi_affiliaters = AffiliateCommission::where('percentage',$affiliate_commission->percentage)->get();
        $affiliaters =  User::role('AFFLIATE MARKETER')->orderBy('id', 'desc')->get();

        return view('admin.commission_percentage.edit',compact('affiliate_commission','affiliaters','commi_affiliaters'));
        
    }

    public function updatePercentage(Request $request)
    {
        $request->validate([
            'percentage' => 'required',
            'affiliaters' => 'required'
        ]);
        if($request->affiliaters){
            $delete_affiliater = AffiliateCommission::where('percentage',$request->percentage)->delete();
            foreach($request->affiliaters as $affiliater){
                $affiliate_commission = new AffiliateCommission;
                $affiliate_commission->affiliate_id = $affiliater;
                $affiliate_commission->percentage = $request->percentage;
                $affiliate_commission->save();
            }
        }

        
        return redirect()->route('commission-percentage.index')->with('message','Commission Percentage Updated Successfully');
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
        $commission = AffiliateCommission::where('id',$id)->first();
        $found_percentages = AffiliateCommission::where('percentage',$commission->percentage)->delete();

        return redirect()->route('commission-percentage.index')->with('message','Commission Percentage Deleted Successfully');

    }
}
