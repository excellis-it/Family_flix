<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class CustomerController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->can('Manage Customer')) {
            $customers = User::role('CUSTOMER')->orderBy('id', 'desc')->paginate(15);
            return view('admin.customer.list',compact('customers'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customerAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $customers = User::role('CUSTOMER')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('id', 'like', '%' . $query . '%')
                    ->orWhere('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('phone', 'like', '%' . $query . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(15);

            return response()->json(['data' => view('admin.customer.table', compact('customers'))->render()]);
        }
    }

    public function changeStatus(Request $request)
    {
       
        $customer = User::find($request->user_id);
        $customer->status = $request->status;
        $customer->save();
        return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
    }
    
}
