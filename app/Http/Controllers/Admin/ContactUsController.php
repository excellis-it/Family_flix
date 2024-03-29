<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    //

    public function contactList()
    { 
        return view('admin.contact.list');
    }

    public function contactAjaxList(Request $request)
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
        $totalRecords = ContactUs::orderBy('id','desc')->count();
        $totalRecordswithFilter = ContactUs::orderBy('id','desc')->count();

        // Fetch records
        $records = ContactUs::query();
        $columns = ['user_name','user_email','user_phone','message'];
        foreach($columns as $column){
            $records->where($column, 'like', '%' . $searchValue . '%');
        }
        $records->orderBy($columnName,$columnSortOrder);
        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();

        $data_arr = array(); 

        foreach($records as $record){
            $user_name = $record->user_name;
            $user_email = $record->user_email;
            $user_phone = $record->user_phone;
            $message = $record->message;

            $id = $record->id;
            
           $data_arr[] = array(
               "user_name" => $user_name,
               "user_email" => $user_email,
               "user_phone" => $user_phone,
               "message" => $message
               
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
