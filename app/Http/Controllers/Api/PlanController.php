<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanSpecification;

class PlanController extends Controller
{
    //

    public function planDetails(Request $request)
    {
        try{
            //plan list with specification with selective field

            $plan = Plan::with(['specification' => function($query){
                $query->select('id', 'plan_id', 'specification_name');
            }])->select('id', 'plan_name', 'plan_details', 'plan_actual_price','plan_offer_price','button_text')->get();

            if($plan->isEmpty()){
                return response()->json([
                    'status' => false,
                    'statusCode' => 200,
                    'message' => 'No plan found',
                ]);
            }
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Plan details found successfully',
                'data' => [
                    'plan' => $plan   
                ]
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }
}
