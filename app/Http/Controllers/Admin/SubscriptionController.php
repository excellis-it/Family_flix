<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionUs;

class SubscriptionController extends Controller
{
    //

    public function subscriptionList()
    {
        return view('admin.subscribers.list');
    }

    public function subscriptionAjaxList(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = SubscriptionUs::orderBy('id','desc')->count();
        $totalRecordswithFilter = SubscriptionUs::orderBy('id','desc')->count();

        // Fetch records
        $records = SubscriptionUs::query();
        $columns = ['email'];
        foreach($columns as $column){
            $records->where($column, 'like', '%' . $searchValue . '%');
        }
        $records->orderBy($columnName,$columnSortOrder);
        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();
        $data_arr = array(); 
        foreach($records as $record){
            $email = $record->email;
            $id = $record->id;
            
            $data_arr[] = array(
               "email" => $email,
            );
        }                                                                                                                                                   
                                                                                                                                                    
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response); 
    }
}
