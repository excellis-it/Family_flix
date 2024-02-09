<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use App\Models\AboutUs;
use App\Models\HomeCms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    use ImageTrait;

    public function homeCms()
    {
        $home_cms = HomeCms::first();
        return view('admin.cms.home', compact('home_cms'));
    }
   
    public function homeStore(Request $request)
    {
        $request->validate([
            'title_1' => 'required',
            'title_2' => 'required',
            'description' => 'required',
            'banner_img' => 'required|image|mimes:jpg,webp,png,jpeg,gif,svg',
        ]);

        $home_cms = new HomeCms();
        $home_cms->title_1 = $request->title_1;
        $home_cms->title_2 = $request->title_2;
        $home_cms->description = $request->description;
        if ($request->hasFile('banner_img')) {
            $request->validate([
                'banner_img' => 'image|mimes:jpg,webp,png,jpeg,gif,svg',
            ]);

            $fileData = $this->imageUpload($request->file('banner_img'), 'cms');
            if (!empty($fileData['filePath'])) {
                if ((!empty($home_cms->banner_img)) && Storage::exists($home_cms->banner_img)) {
                    Storage::delete($home_cms->banner_img);
                }
                $home_cms->banner_img = $fileData['filePath'] ?? null;
            }
        }
        $home_cms->save();
        return redirect()->route('cms.home-list')->with('message', 'Home Created Successfully');
    }

   
}
