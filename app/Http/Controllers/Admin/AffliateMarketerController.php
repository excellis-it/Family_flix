<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Models\User;
use App\Models\AffiliateCommission;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AffliateMarketerController extends Controller
{

    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->can('Manage Affiliater')) {
            $affiliaters =  User::role('AFFLIATE MARKETER')->orderBy('id', 'desc')->paginate(15);
            return view('admin.affliate-marketer.list', compact('affiliaters'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function affliateMarketerAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query', '');
            $query = str_replace(" ", "%", $query);
            $limit = $request->get('limit', 15); // Default is 15 per page


                $affiliaters = User::role('AFFLIATE MARKETER')
                    ->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('id', 'like', '%' . $query . '%')
                            ->orWhere('name', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%')
                            ->orWhere('phone', 'like', '%' . $query . '%');
                    })
                    ->orderBy('id', 'desc')
                    ->paginate((int)$limit); // Paginate with limit
            return response()->json(['data' => view('admin.affliate-marketer.filter', compact('affiliaters'))->render()]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('Create Affiliater')) {
            return view('admin.affliate-marketer.create');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
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
            'name' => 'required',
            'email' => 'required|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'phone' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'status' => 'required',

        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->phone = $request->phone;
        $data->status = $request->status;
        if ($request->hasFile('profile_picture')) {
            $data->image = $this->imageUpload($request->file('profile_picture'), 'Affiliate Marketer')['filePath'];
        }
        $data->save();

        $affiliate_commission = new AffiliateCommission;
        $affiliate_commission->affiliate_id = $data->id;
        $affiliate_commission->percentage = $request->commission_percentage;
        $affiliate_commission->save();

        $data->assignRole('AFFLIATE MARKETER');
        $maildata = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => 'Affiliate Marketer',
        ];

        Mail::to($request->email)->send(new RegistrationMail($maildata));
        return redirect()->route('affliate-marketer.index')->with('message', 'Affiliate Marketer created successfully.');
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
        if (Auth::user()->can('Edit Affiliater')) {
            $affiliate_marketer = User::findOrFail($id);
            $affiliate_commission = AffiliateCommission::where('affiliate_id', $id)->first() ?? '';
            return view('admin.affliate-marketer.edit')->with(compact('affiliate_marketer', 'affiliate_commission'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email,' . $id,
            'phone' => 'required',
            'status' => 'required',

        ]);
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->status = $request->status;
        if ($request->password != null) {
            $request->validate([
                'password' => 'min:8',
                'confirm_password' => 'min:8|same:password',
            ]);
            $data->password = bcrypt($request->password);
        }
        if ($request->hasFile('profile_picture')) {
            $request->validate([
                'profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg',
            ]);

            if ($data->profile_picture) {
                $currentImageFilename = $data->profile_picture; // get current image name
                Storage::delete('app/' . $currentImageFilename);
            }
            $data->image = $this->imageUpload($request->file('profile_picture'), 'Affiliate Marketer')['filePath'];
        }
        $data->save();

        $update_commission = AffiliateCommission::where('affiliate_id', $data->id)->first();
        if ($update_commission) {
            $update_commission->percentage = $request->commission_percentage;
            $update_commission->update();
        } else {
            $add_commission = new AffiliateCommission;
            $add_commission->affiliate_id = $data->id;
            $add_commission->percentage = $request->commission_percentage;
            $add_commission->save();
        }

        return redirect()->route('affliate-marketer.index')->with('message', 'Affiliate Marketer updated successfully.');
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

    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('affliate-marketer.index')->with('error', 'Affiliate Marketer has been deleted successfully.');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No affiliate marketer selected']);
        }

        try {
            User::whereIn('id', $ids)->delete();

            return response()->json(['success' => true, 'message' => 'Selected affiliate marketer deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete affiliate marketer']);
        }
    }
}
