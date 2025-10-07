<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopGrid;
use Illuminate\Support\Facades\Auth;

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
        $top_grids = TopGrid::orderBy('id','desc')->paginate(15);
        return view('admin.top_grid.list',compact('top_grids'));
    }

    public function topGridAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $top_grids = TopGrid::where('id', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.top_grid.filter', compact('top_grids'))->render()]);
        }

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
        $top_grid->img_alt_tag = $request->img_alt_tag;

        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required|mimes:jpeg,jpg,png,gif',
            ]);

            $file15 = $request->file('icon');
            $filename15 = date('YmdHi').$file15->getClientOriginalName();
            $image_path15 = $request->file('icon')->store('grid', 'public');
            $top_grid->icon = $image_path15;
        }

        $top_grid->save();

        return redirect()->route('top-grid.index')->with('message','top grid added successfully');


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
        $update_top_grid->img_alt_tag = $request->img_alt_tag;

        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required',
            ]);

            $file1= $request->file('icon');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $image_path1 = $request->file('icon')->store('grid', 'public');
            $description->icon = $image_path1;
        }
        $update_top_grid->save();

        return redirect()->route('top-grid.index')->with('message','top grid updated successfully');

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
