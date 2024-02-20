<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EntertainmentBanner;

class EntertainmentBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View('admin.entertainment_banner.list');
    }

    public function entertainmentBannerAjaxList(Request $request)
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
        $totalRecords = EntertainmentBanner::orderBy('id','desc')->count();
        $totalRecordswithFilter = EntertainmentBanner::orderBy('id','desc')->count();

        // Fetch records
        $records = EntertainmentBanner::query();
        $columns = ['banner_image','small_text','banner_type'];
        foreach($columns as $column){
            $records->where($column, 'like', '%' . $searchValue . '%');
        }
        $records->orderBy($columnName,$columnSortOrder);
        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();

        $data_arr = array(); 

        foreach($records as $record){
            $banner_image = $record->banner_image;
            $small_text = $record->small_text;
            $banner_type = $record->banner_type;
            $id = $record->id;
            
           $data_arr[] = array(
               "banner_image" => $banner_image,
               "small_text" => $small_text,
               "banner_type" => $banner_type,
               "action" => '<a href="'.route('entertainment-banner.edit',$id).'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a href="'.route('delete.entertainment-banner',$id).'" onclick="return confirm(`Are you sure you want to delete this banner?`)"><i class="fas fa-trash"></i></a>',
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entertainment_banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'rating'     => 'required',
            'small_text'    => 'required',
            'long_description'    => 'required',
            'button_name'    => 'required',
            'banner_type'    => 'required',
        ]);

        $entertainment_banner = new EntertainmentBanner();
        $entertainment_banner->rating = $request->rating;
        $entertainment_banner->small_text = $request->small_text;
        $entertainment_banner->long_description = $request->long_description;
        $entertainment_banner->banner_type = $request->banner_type;
        $entertainment_banner->button_name = $request->button_name;

        if ($request->hasFile('banner_image')) {
            $request->validate([
                'banner_image' => 'required',
            ]);
            
            $file1= $request->file('banner_image');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('banner_image')->store('entertainment_banner', 'public');
            $entertainment_banner->banner_image = $image_path1;
        }

        
        if ($request->hasFile('banner_logo')) {
            $request->validate([
                'banner_logo' => 'required',
            ]);
            
            $file11= $request->file('banner_logo');
            $filename11= date('YmdHi').$file11->getClientOriginalName();
            $image_path11 = $request->file('banner_logo')->store('entertainment_banner', 'public');
            $entertainment_banner->banner_logo = $image_path11;
        }


        $entertainment_banner->save();

        return back()->with('message','Entertainment banner created successfully');
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
        $banner_detail = EntertainmentBanner::where('id',$id)->first();
        return view('admin.entertainment_banner.edit',compact('banner_detail'));
    }

    public function updateEntertainmentBanner(Request $request)
    {
        $update_ent_banner = EntertainmentBanner::where('id',$request->id)->first();
        $update_ent_banner->rating = $request->rating;
        $update_ent_banner->small_text = $request->small_text;
        $update_ent_banner->long_description = $request->long_description;
        $update_ent_banner->banner_type = $request->banner_type;
        $update_ent_banner->button_name = $request->button_name;

        if ($request->hasFile('banner_image')) {
            $request->validate([
                'banner_image' => 'required',
            ]);
            
            $file1= $request->file('banner_image');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('banner_image')->store('entertainment_banner', 'public');
            $update_ent_banner->banner_image = $image_path1;
        }

        
        if ($request->hasFile('banner_logo')) {
            $request->validate([
                'banner_logo' => 'required',
            ]);
            
            $file11= $request->file('banner_logo');
            $filename11= date('YmdHi').$file11->getClientOriginalName();
            $image_path11 = $request->file('banner_logo')->store('entertainment_banner', 'public');
            $update_ent_banner->banner_logo = $image_path11;
        }

        $update_ent_banner->update();

        return back()->with('message','Entertainment banner updated successfully');
    }

    public function deleteEntertainmentBanner($id)
    {
        $delete_banner = EntertainmentBanner::where('id',$id)->delete();
        return back()->with('error','Entertainment banner deleted successfully');
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
}
