<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalProduct;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanSpecification;
use App\Traits\PayPalTrait;
use Carbon\Carbon;
use App\Helpers\Helper;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Braintree\Gateway;


class PlanController extends Controller
{
    use PayPalTrait;
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->can('Manage Plan')) {
            $plans = Plan::orderBy('plan_order', 'asc')->paginate(15);
            return view('admin.plan.list', compact('plans'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
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
        if (Auth::user()->can('Create Plan')) {
            return view('admin.plan.create');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
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
            'plan_name'        => 'required',
            'plan_details'     => 'required',
            'plan_actual_price' => 'required|numeric',
            'plan_offer_price' => 'required|numeric|unique:plans,plan_offer_price',
            'button_text'      => 'required',
        ]);

        try {
            // Create a plan on Braintree
            $result = $this->gateway->plan()->create([
                'id' => 'plan_' . time(),  // Unique Plan ID
                'name' => $request->plan_name,
                'description' => $request->plan_details,
                'price' => $request->plan_offer_price,  // Set the price here
                'billingDayOfMonth' => 1,  // Billing day (e.g., the 1st day of the month)
                'billingFrequency' => 1,  // Frequency of billing (1 = monthly, 12 = yearly)
                'numberOfBillingCycles' => null,  // Set to null for indefinite billing cycles
                'currencyIsoCode' => 'USD',  // e.g., 'USD'
                'trialPeriod' => false,  // Set true/false based on trial days
                // 'trialDuration' => $request->plan_trial_days,  // Number of trial days
                // 'trialDurationUnit' => 'day',  // Unit for trial duration ('day' or 'month')
            ]);

            // dd($result);

            if ($result->success) {
                // Handle successful creation of a plan on Braintree
                $braintree_plan_id = $result->plan->id;

                // Save the plan data to your database
                $plan = new Plan();
                $plan->braintree_plan_id = $braintree_plan_id;
                $plan->plan_name = $request->plan_name;
                $plan->plan_details = $request->plan_details;
                $plan->plan_actual_price = $request->plan_actual_price;
                $plan->plan_offer_price = $request->plan_offer_price;
                $plan->button_text = $request->button_text;
                $plan->plan_order = Plan::max('plan_order') + 1;
                $plan->save();

                // Add plan specifications if provided
                $id = $plan->id;
                foreach ($request->plan_specification as $specification) {
                    if ($specification != null) {
                        PlanSpecification::create([
                            'plan_id' => $id,
                            'specification_name' => $specification,
                        ]);
                    }
                }

                return redirect()->route('plan.index')->with('success', 'Plan has been created successfully.');
            } else {
                // Handle failure
                return redirect()->back()->with('error', 'Failed to create the plan in Braintree.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
            'plan_name' => 'required',
            'plan_details' => 'required',
            'plan_actual_price' => 'required|numeric',
            'plan_offer_price' => 'required|numeric',
            'button_text' => 'required',
            // 'currency' => 'required|string', // Currency code
            // 'billing_frequency' => 'required|integer', // Billing frequency (e.g., 1 = monthly)
        ]);

        // Fetch the existing plan details
        $plan = Plan::find($request->plan_id);

        if (!$plan) {
            return redirect()->back()->with('error', 'Plan not found.');
        }

        try {
            // Create a new plan in Braintree
            $result = $this->gateway->plan()->create([
                'id' => 'plan_' . time(),  // Unique Plan ID
                'name' => $request->plan_name,
                'description' => $request->plan_details,
                'price' => $request->plan_offer_price,  // Set the price here
                'billingDayOfMonth' => 1,  // Billing day (e.g., the 1st day of the month)
                'billingFrequency' => 1,  // Frequency of billing (1 = monthly, 12 = yearly)
                'numberOfBillingCycles' => null,  // Set to null for indefinite billing cycles
                'currencyIsoCode' => 'USD',  // e.g., 'USD'
                'trialPeriod' => false,  // Set true/false based on trial days
                // 'trialDuration' => $request->plan_trial_days,  // Number of trial days
                // 'trialDurationUnit' => 'day',  // Unit for trial duration ('day' or 'month')
            ]);

            if ($result->success) {
                // Update the plan in your database
                $plan->plan_name = $request->plan_name;
                $plan->plan_details = $request->plan_details;
                $plan->plan_actual_price = $request->plan_actual_price;
                $plan->plan_offer_price = $request->plan_offer_price;
                $plan->braintree_plan_id = $result->plan->id; // Update the Braintree plan ID
                $plan->update();

                // Update plan specifications if provided
                if ($request->plan_specification != null) {
                    PlanSpecification::where('plan_id', $plan->id)->delete();
                    foreach ($request->plan_specification as $specification) {
                        if ($specification != null) {
                            PlanSpecification::create([
                                'plan_id' => $plan->id,
                                'specification_name' => $specification,
                            ]);
                        }
                    }
                }

                return redirect()->route('plan.index')->with('success', 'Plan updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Error creating new plan in Braintree: ' . $result->message);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
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
