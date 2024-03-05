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
        $entertainment_banners = EntertainmentBanner::orderBy('id','desc')->paginate(15);
        return View('admin.entertainment_banner.list',compact('entertainment_banners'));
    }

    public function entertainmentBannerAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $entertainment_banners = EntertainmentBanner::where('id', 'like', '%' . $query . '%')
                    ->orWhere('banner_type', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(15);

            return response()->json(['data' => view('admin.entertainment_banner.filter', compact('entertainment_banners'))->render()]);
        }
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

        return redirect()->route('entertainment-banner.index')->with('message','Entertainment banner created successfully');

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

        return redirect()->route('entertainment-banner.index')->with('message','Entertainment banner updated successfully');
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
