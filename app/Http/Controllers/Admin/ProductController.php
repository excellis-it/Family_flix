<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list');

    }

    public function productAjaxList(Request $request)
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
        $totalRecords = Product::orderBy('id','desc')->count();
        $totalRecordswithFilter = Product::orderBy('id','desc')->count();

        // Fetch records
        $records = Product::query();
        $columns = ['type','product_image','top_10_status','popular_status'];
        foreach($columns as $column){
            $records->where($column, 'like', '%' . $searchValue . '%');
        }
        $records->orderBy($columnName,$columnSortOrder);
        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();

        $data_arr = array(); 

        foreach($records as $record){
            $type = $record->type;
            $product_image = $record->product_image;
            $top_10_status = $record->top_10_status;
            $popular_status = $record->popular_status;
            $id = $record->id;

            
           $data_arr[] = array(
               "product_image" => $product_image,
               "type" => $type,
               "top_10_status" => '<div class="button-switch"><input type="checkbox" id="switch-orange" class="switch toggle-class" data-id="'.$record->id.'"'.($record->top_10_status ? 'checked' : '').'/><label for="switch-orange" class="lbl-off"></label><label for="switch-orange" class="lbl-on"></label></div>',
               "popular_status" => '<div class="button-switch"><input type="checkbox" id="switch-orange" class="switch toggle-class-popular" data-id="'.$record->id.'"'.($record->popular_status ? 'checked' : '').'/><label for="switch-orange" class="lbl-off"></label><label for="switch-orange" class="lbl-on"></label></div>',
               "action" => '<a href="'.route('products.edit',$id).'"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a href="'.route('delete.products',$id).'" onclick="return confirm(`Are you sure you want to delete this product?`)"><i class="fas fa-trash"></i></a>',
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

    public function changeProductTopStatus(Request $request)
    {
        $change_top10_status = Product::where('id',$request->pro_id)->first();
        $change_top10_status->top_10_status = $request->status;
        $change_top10_status->update();

        return response()->json(['success'=>'Status change successfully.']);
    }

    public function changePopularStatus(Request $request)
    {
        $change_popular_status = Product::where('id',$request->pro_id)->first();
        $change_popular_status->popular_status = $request->status;
        $change_popular_status->update();

        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
            'type'     => 'required',
            'product_image'   => 'required',
        ]);

        $product_store = new Product();
        $product_store->type = $request->type;
        if ($request->hasFile('product_image')) {
            $request->validate([
                'product_image' => 'required',
            ]);
            
            $file1= $request->file('product_image');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('product_image')->store('product', 'public');
            $product_store->product_image = $image_path1;
        }
        $product_store->save();

        return redirect()->route('products.index')->with('message','product added successfully');
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
        $product_edit = Product::where('id',$id)->first();
        return view('admin.product.edit',compact('product_edit'));
    }

    public function updateProducts(Request $request)
    {
        $request->validate([
            'type'     => 'required',
        ]);

        $product_update = Product::where('id',$request->product_id)->first();
        $product_update->type = $request->type;
        if ($request->hasFile('product_image')) {
            $request->validate([
                'product_image' => 'required',
            ]);
            
            $file1= $request->file('product_image');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('product_image')->store('product', 'public');
            $product_update->product_image = $image_path1;
        }
        $product_update->update();

        return back()->with('message','product updated successfully');
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

    public function deleteProduct($id)
    {
        $delete_product = Product::where('id',$id)->first();
        $delete_product->delete();

        return back()->with('error','Product deleted successfully');
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
