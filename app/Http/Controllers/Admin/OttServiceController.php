<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OttService;


class OttServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ott_services = OttService::orderBy('id','desc')->paginate(15);
        return view('admin.ott_services.list',compact('ott_services'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ott_services.create');
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
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
        ]);

        $ott_icon = new OttService();
        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required',
            ]);
            
            $file= $request->file('icon');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $image_path = $request->file('icon')->store('ott_icon', 'public');
            $ott_icon->icon = $image_path;
        }

        $ott_icon->save();
        
        return redirect()->route('ott-service.index')->with('message','Ott Service Icon Added Successfully');
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
        $ott_service = OttService::find($id);
        return view('admin.ott_services.edit',compact('ott_service'));
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

    public function updateOttService(Request $request)
    {

        $ott_service = OttService::find($request->id);
        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
            ]);
            
            $file= $request->file('icon');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $image_path = $request->file('icon')->store('ott_icon', 'public');
            $ott_service->icon = $image_path;
        }

        $ott_service->update();
        return redirect()->route('ott-service.index')->with('message','Ott Service Icon Updated Successfully');
    }

    public function deleteOttService($id)
    {
        $ott_service = OttService::find($id);
        $ott_service->delete();

        return redirect()->route('ott-service.index')->with('error','Ott Service Icon Deleted Successfully');
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
