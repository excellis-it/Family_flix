<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaypalProduct;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanSpecification;
use App\Traits\PayPalTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PlanController extends Controller
{
    use PayPalTrait;
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
            'plan_name'     => 'required',
            'plan_details'    => 'required',
            'plan_actual_price'    => 'required|numeric',
            'plan_offer_price'    => 'required|numeric',
            'button_text'    => 'required',
        ]);

        $paypal_item = PaypalProduct::orderBy('id', 'desc')->first();
        if ($paypal_item) {


            $data = [
                "product_id" => $paypal_item->product_id,
                "name" => $request->plan_name,
                "description" => $request->plan_details,
                "status" => "ACTIVE",
                "billing_cycles" => [
                    [
                        "frequency" => [
                            "interval_unit" => "MONTH",
                            "interval_count" => 1
                        ],
                        "tenure_type" => "TRIAL",
                        "sequence" => 1,
                        "total_cycles" => 1,
                        "pricing_scheme" => [
                            "fixed_price" => [
                                "value" => $request->plan_offer_price,
                                "currency_code" => "USD"
                            ]
                        ]
                    ],
                    [
                        "frequency" => [
                            "interval_unit" => "MONTH",
                            "interval_count" => 1
                        ],
                        "tenure_type" => "REGULAR",
                        "sequence" => 2,
                        "total_cycles" => 12,
                        "pricing_scheme" => [
                            "fixed_price" => [
                                "value" => $request->plan_actual_price,
                                "currency_code" => "USD"
                            ]
                        ]
                    ]
                ],
                "payment_preferences" => [
                    "auto_bill_outstanding" => true,
                    "setup_fee" => [
                        "value" => "10",
                        "currency_code" => "USD"
                    ],
                    "setup_fee_failure_action" => "CONTINUE",
                    "payment_failure_threshold" => 3
                ],
                "taxes" => [
                    "percentage" => "10",
                    "inclusive" => false
                ]
            ];

            // dd(json_encode($data));
            $response = $this->createPlan($data);
            // return $response;
        } else {
            $response = null;
        }
        $old_plan = Plan::orderBy('plan_order', 'desc')->first();
        if ($old_plan) {
            $order = $old_plan->plan_order + 1;
        } else {
            $order = 1;
        }
        $plan = new Plan();
        if ($response != null && isset($response->id)) {
            $plan->paypal_plan_id = $response->id;
        }
        $plan->plan_name = $request->plan_name;
        $plan->plan_details = $request->plan_details;
        $plan->plan_actual_price = $request->plan_actual_price;
        $plan->plan_offer_price = $request->plan_offer_price;
        $plan->button_text = $request->button_text;
        $plan->plan_order = $order;
        $plan->save();

        $id = $plan->id;
        foreach ($request->plan_specification as $key => $specification) {
            if ($specification != null) {
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
        // try {
        $plan_update = Plan::where('id', $request->id)->first();

        if ($plan_update->paypal_plan_id) { {
                // dd($plan_update->paypal_plan_id);
                $data = [
                    "pricing_schemes" => [
                        [
                            "billing_cycle_sequence" => 1,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $request->plan_offer_price,
                                    "currency_code" => "USD"
                                ],
                                "roll_out_strategy" => [
                                   "effective_time" => Carbon::now()->format('Y-m-d\TH:i:s\Z'),
                                    "process_change_from" => "NEXT_PAYMENT"
                                ]
                            ]
                        ],
                        [
                            "billing_cycle_sequence" => 2,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $request->plan_actual_price,
                                    "currency_code" => "USD"
                                ],
                                "roll_out_strategy" => [
                                    "effective_time" => Carbon::now()->format('Y-m-d\TH:i:s\Z'),
                                    "process_change_froms" => "NEXT_PAYMENT",
                                ]
                            ]
                        ]
                    ]
                ];
            }
            // dd(json_encode($plan_update->paypal_plan_id));
            $update_response = $this->updatePricing($data, $plan_update->paypal_plan_id);
            // dd($update_response);
            $response = null;
        } else {
            $paypal_item = PaypalProduct::orderBy('id', 'desc')->first();
            if ($paypal_item) {
                $data = [
                    "product_id" => $paypal_item->product_id,
                    "name" => $request->plan_name,
                    "description" => $request->plan_details,
                    "status" => "ACTIVE",
                    "billing_cycles" => [
                        [
                            "frequency" => [
                                "interval_unit" => "MONTH",
                                "interval_count" => 1
                            ],
                            "tenure_type" => "TRIAL",
                            "sequence" => 1,
                            "total_cycles" => 1,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $request->plan_offer_price,
                                    "currency_code" => "USD"
                                ]
                            ]
                        ],
                        [
                            "frequency" => [
                                "interval_unit" => "MONTH",
                                "interval_count" => 1
                            ],
                            "tenure_type" => "REGULAR",
                            "sequence" => 2,
                            "total_cycles" => 12,
                            "pricing_scheme" => [
                                "fixed_price" => [
                                    "value" => $request->plan_actual_price,
                                    "currency_code" => "USD"
                                ]
                            ]
                        ]
                    ],
                    "payment_preferences" => [
                        "auto_bill_outstanding" => true,
                        "setup_fee" => [
                            "value" => "10",
                            "currency_code" => "USD"
                        ],
                        "setup_fee_failure_action" => "CONTINUE",
                        "payment_failure_threshold" => 3
                    ],
                    "taxes" => [
                        "percentage" => "10",
                        "inclusive" => false
                    ]
                ];

                $response = $this->createPlan($data);
            } else {
                $response = null;
            }
        } // end of else

        if ($response != null && isset($response->id)) {
            $plan_update->paypal_plan_id = $response->id;
        }

        $plan_update->plan_name = $request->plan_name;
        $plan_update->plan_details = $request->plan_details;
        $plan_update->plan_actual_price = $request->plan_actual_price;
        $plan_update->plan_offer_price = $request->plan_offer_price;
        $plan_update->button_text = $request->button_text;
        $plan_update->update();

        if ($request->plan_specification != null) {
            PlanSpecification::where('plan_id', $request->id)->delete();
            foreach ($request->plan_specification as $key => $specification) {
                if ($specification != null) {
                    $plan_specification = PlanSpecification::create([
                        'plan_id' => $request->id,
                        'specification_name' => $specification,
                    ]);
                }
            }
        }

        return redirect()->route('plan.index')->with('message', 'Plan updated successfully');
        // } catch (\Throwable $th) {
        //     return redirect()->route('plan.index')->with('error', 'Something went wrong');
        // }
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
