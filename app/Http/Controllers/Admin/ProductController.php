<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('Manage Product')) {
            $products = Product::orderBy('id','desc')->paginate(15);
        return view('admin.product.list',compact('products'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        

    }

    public function productAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = Product::where('id', 'like', '%' . $query . '%')
                    ->orWhere('type', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.product.filter', compact('products'))->render()]);
        }
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

    public function changeUnbeatableStatus(Request $request)
    {
       
        $change_unbeatable_status = Product::where('id',$request->pro_id)->first();
        $change_unbeatable_status->unbeatable_status = $request->status;
        $change_unbeatable_status->update();

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

        return redirect()->route('products.index')->with('message','Product updated successfully');
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
