<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class MenuManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('order','asc')->paginate(15);
        return view('admin.site_management.menu.list',compact('menus'));
    }

    public function fetchDataMenu(Request $request)
    {
       
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $menus = Menu::where('id', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%')
                    ->orWhere('slug', 'like', '%' . $query . '%')
                    ->orderBy('order', 'asc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.site_management.menu.filter', compact('menus'))->render()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_menus = Menu::where('parent_id',0)->get();
        return view('admin.site_management.menu.create',compact('parent_menus'));
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
            'title'     => 'required',
            'status'    => 'required|in:0,1',
        ]);

        $menu_add = new Menu();
        $menu_add->title = $request->title;
        $menu_add->slug = Str::slug($request->title);
        if($request->parent_id !=''){
            $menu_add->parent_id = $request->parent_id;
        }
        $menu_add->status = $request->status;
        $menu_add->save();

        return redirect()->route('menu-management.index')->with('message','Menu created successfully');
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
        $menu = Menu::findOrFail($id);
        $parent_menus = Menu::where('parent_id',0)->get();
        return view('admin.site_management.menu.edit',compact('menu','parent_menus'));
    }

    public function menuUpdate(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'status'    => 'required|in:0,1',
        ]);

        $menu_add = Menu::where('id', $request->id)->first();
        $menu_add->title = $request->title;
        $menu_add->slug = Str::slug($request->title);
        if($request->parent_id !=''){
            $menu_add->parent_id = $request->parent_id;
        }
        $menu_add->status = $request->status;
        $menu_add->update();

        return redirect()->route('menu-management.index')->with('message','Menu updated successfully');
    }

    public function menuReorder(Request $request)
    {
        
        $menus = Menu::all();

        foreach ($menus as $menu) {

            foreach ($request->order as $order) {

                if ($order['id'] == $menu->id) {

                    $menu->update(['order' => $order['position']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }

    public function menuDelete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu-management.index')->with('message','Menu deleted successfully');
    }

    public function menuStatus(Request $request)
    {
        $menu_status = Menu::findOrFail($request->menu_id);
        $menu_status->status = $request->status;
        $menu_status->update();

        return response()->json(['message' => 'Status change successfully.']);
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
