<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Plan;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coupons = Coupon::orderBy('id','desc')->with('plan')->get();
        return view('admin.coupon.list',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::orderBy('plan_order','asc')->get();
        return view('admin.coupon.create',compact('plans'));
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
            'plan_id' => 'required',
            'code' => 'required',
            'coupon_type' => 'required',
            'user_type' => 'required',
            'value' => 'required',
            'status' => 'required',
        ]);

        $coupon_create = new Coupon();
        $coupon_create->plan_id = $request->plan_id;
        $coupon_create->code = $request->code;
        $coupon_create->coupon_type = $request->coupon_type;
        $coupon_create->user_type = $request->user_type;
        $coupon_create->value = $request->value;
        $coupon_create->status = $request->status;
        $coupon_create->save();

        return redirect()->route('coupons.index')->with('message' ,'Coupon added successfully');

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
        $plans = Plan::orderBy('plan_order','asc')->get();
        $coupon_edit = Coupon::where('id',$id)->first();
        return view('admin.coupon.edit',compact('coupon_edit','plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       

    }

    public function updateCoupon(Request $request)
    {
        $request->validate([
            'plan_id' => 'required',
            'code' => 'required',
            'coupon_type' => 'required',
            'value' => 'required',
            'user_type' => 'required',
            'status' => 'required',
        ]);

        $coupon_edit = Coupon::where('id',$request->coupon_id)->first();
        $coupon_edit->plan_id = $request->plan_id;
        $coupon_edit->code = $request->code;
        $coupon_edit->coupon_type = $request->coupon_type;
        $coupon_edit->user_type = $request->user_type;
        $coupon_edit->value = $request->value;
        $coupon_edit->status = $request->status;
        $coupon_edit->update();


        return redirect()->route('coupons.index')->with('message','Coupon updated successfully');
        
    }

    public function couponStatus(Request $request)
    {
        $coupon_status = Coupon::where('id',$request->coupon_id)->first();
        $coupon_status->status = $request->status;
        $coupon_status->update();
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function deleteCoupon($id)
    {
        $delete_coupon = Coupon::where('id',$id)->delete();
        return back()->with('error','Coupon deleted successfully');
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
