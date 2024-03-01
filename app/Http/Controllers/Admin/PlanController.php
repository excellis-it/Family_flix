<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanSpecification;


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::orderBy('plan_order','asc')->paginate(15);
        return view('admin.plan.list', compact('plans'));
    }

    public function fetchPlanData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $plans = Plan::where('id', 'like', '%' . $query . '%')
                    ->orWhere('plan_name', 'like', '%' . $query . '%')
                    ->orWhere('plan_details', 'like', '%' . $query . '%')
                    ->orWhere('plan_actual_price', 'like', '%' . $query . '%')
                    ->orWhere('plan_offer_price', 'like', '%' . $query . '%')
                    ->orderBy('plan_order', 'asc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.plan.filter', compact('plans'))->render()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plan.create');
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
            'plan_name'     => 'required',
            'plan_details'    => 'required',
            'plan_actual_price'    => 'required|numeric',
            'plan_offer_price'    => 'required|numeric',
            'button_text'    => 'required',
        ]);

        $plan = new Plan();
        $plan->plan_name = $request->plan_name;
        $plan->plan_details = $request->plan_details;
        $plan->plan_actual_price = $request->plan_actual_price;
        $plan->plan_offer_price = $request->plan_offer_price;
        $plan->button_text = $request->button_text;
        $plan->save();

        $id = $plan->id;
        foreach ($request->plan_specification as $key => $specification) {
            if($specification != null){
                $plan_specification = PlanSpecification::create([
                    'plan_id' => $id,
                    'specification_name' => $specification,
                ]);
            }    
        }

        return redirect()->route('plan.index')->with('success', 'Plan has been created successfully');
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
        $plan = Plan::find($id);
        return view('admin.plan.edit', compact('plan'));
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

    public function planDelete($id)
    {
        $plan = Plan::find($id);
        $plan->delete();
        return redirect()->route('plan.index')->with('message', 'Plan has been deleted successfully');
    }

    public function planReorder(Request $request)
    {
        
        $plans = Plan::all();
        foreach ($plans as $plan) {
            foreach ($request->order as $order) {
                if ($order['id'] == $plan->id) {
                    $plan->update(['plan_order' => $order['position']]);
                }
            }
        }
           
        return response(['message' => 'Update Successfully'], 200);
    }

    public function planUpdate(Request $request)
    {
         
        $request->validate([
            'plan_name'     => 'required',
            'plan_details'    => 'required',
            'plan_actual_price'    => 'required|numeric',
            'plan_offer_price'    => 'required|numeric',
            'button_text'    => 'required',
        ]);
        
        $plan_update = Plan::where('id', $request->id)->first();
        $plan_update->plan_name = $request->plan_name;
        $plan_update->plan_details = $request->plan_details;
        $plan_update->plan_actual_price = $request->plan_actual_price;
        $plan_update->plan_offer_price = $request->plan_offer_price;
        $plan_update->button_text = $request->button_text;
        $plan_update->update();

        if($request->plan_specification != null)
        {
            PlanSpecification::where('plan_id',$request->id)->delete();
            foreach ($request->plan_specification as $key => $specification) {
                if($specification != null){
                    $plan_specification = PlanSpecification::create([
                        'plan_id' => $request->id,
                        'specification_name' => $specification,
                    ]);
                }    
            }
        }

        return redirect()->route('plan.index')->with('message', 'Plan updated successfully');
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
