<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanSpecification;

/**
 * @group Listing APIs
 *
 * APIs for Plan Listing
 */

class PlanController extends Controller
{
   

    /**
     *  Plan-List Api
     * @return \Illuminate\Http\Response
     * @response {
     *"status": true,
     *   "statusCode": 200,
     *   "message": "Plan details found successfully",
     *   "data": {
     *       "plan": [
     *       {
     *           "id": 1,
     *           "plan_name": "Starter",
     *           "plan_details": "Welcome to our starter pack where 2 people can enjoy unlimited movies and shows.",
     *           "plan_actual_price": "30",
     *           "plan_offer_price": "25",
     *           "button_text": "Subscribe",
     *           "specification": [
     *               {
     *                   "id": 1,
     *                   "plan_id": 1,
     *                   "specification_name": "1-2 Device Limit"
     *               },
     *               {
     *                   "id": 2,
     *                   "plan_id": 1,
     *                   "specification_name": "Preminum Server"
     *               },
     *               {
     *                   "id": 3,
     *                   "plan_id": 1,
     *                   "specification_name": "Full HD Available"
     *               },
     *               {
     *                   "id": 4,
     *                   "plan_id": 1,
     *                   "specification_name": "Desktop, Mobile and TV App"
     *               },
     *               {
     *                   "id": 5,
     *                   "plan_id": 1,
     *                   "specification_name": "Unlimited Movies and TV Shows"
     *               }
     *           ]
     *       },
     *   ]
     *  }
     * @response 401 {
     * "status": false,
     * "statusCode": 401,
     * "error": {
     * "message": [
     *      "No detail found!"
     *  ]
     * }
     * }
    */

    public function planDetails(Request $request)
    {
        try{

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
                'status' => 401,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ]);
        }
    }
}
