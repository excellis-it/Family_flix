<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopGrid;

class TopGridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $top_grids = TopGrid::orderBy('id','desc')->get();
        return view('admin.top_grid.list',compact('top_grids'));
    }

    public function topGridAjaxList(Request $request)
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
        $totalRecords = TopGrid::orderBy('id','desc')->count();
        $totalRecordswithFilter = TopGrid::orderBy('id','desc')->count();

        // Fetch records
        $records = TopGrid::query();
        $columns = ['icon','title'];
        foreach($columns as $column){
            $records->where($column, 'like', '%' . $searchValue . '%');
        }
        $records->orderBy($columnName,$columnSortOrder);
        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();

        $data_arr = array(); 

        foreach($records as $record){
            $icon = $record->icon;
            $title = $record->title;
            $id = $record->id;
            
           $data_arr[] = array(
               "icon" => $icon,
               "title" => $title,
               "action" => '<a href="'.route('top-grid.edit',$id).'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a href="'.route('delete.top-grid',$id).'" onclick="return confirm(`Are you sure you want to delete this topgrid?`)"><i class="fas fa-trash"></i></a>',
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

        return view('admin.top_grid.create');
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
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $top_grid = new TopGrid();
        $top_grid->title = $request->title;
        $top_grid->description = $request->description;

        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required',
            ]);
            
            $file15 = $request->file('icon');
            $filename15 = date('YmdHi').$file15->getClientOriginalName();
            $image_path15 = $request->file('icon')->store('grid', 'public');
            $top_grid->icon = $image_path15;
        }
        
        $top_grid->save();

        return back()->with('message','Top grid added successfully');


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
        $top_grid = TopGrid::where('id',$id)->first();
        return view('admin.top_grid.edit',compact('top_grid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function updateTopGrid(Request $request)
     {

        $update_top_grid = TopGrid::where('id',$request->id)->first();
        $update_top_grid->title = $request->title;
        $update_top_grid->description = $request->description;
    
        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required',
            ]);
            
            $file1= $request->file('icon');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('icon')->store('grid', 'public');
            $description->icon = $image_path1;
        }

        return back()->with('message','Update Top Grid successfully');

     }

    public function update(Request $request, $id)
    {
        //
    }

    public function deleteTopGrid($id)
    {
        $delete_to_grid = TopGrid::where('id',$id)->delete();
        return back()->with('error','Grid delted successfully');
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
