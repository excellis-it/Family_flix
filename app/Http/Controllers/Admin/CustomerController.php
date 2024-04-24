<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;



class CustomerController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->can('Manage Customer')) {
            $customers = User::with('userLastSubscription')->role('CUSTOMER')->orderBy('id', 'desc')->paginate(15);
            // dd($customers);
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
            ->with('userLastSubscription')
            ->orderBy('id', 'desc')
            ->paginate(15);

            return response()->json(['data' => view('admin.customer.table', compact('customers'))->render()]);
        }
    }

    public function showPlans($id)
    {
        $subscriptions = UserSubscription::where('customer_id', $id)->orderBy('id', 'desc')->paginate(12);
        return view('admin.customer.show-plans', compact('subscriptions'));
    }

    public function changeStatus(Request $request)
    {
    //    return $request;
        $customer = User::find($request->user_id);
        $customer->status = $request->status;
        $customer->save();
        // session()->flash('message', 'Status updated successfully');
        return response()->json(['status' => 'success', 'message' => 'Status updated successfully']);
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'status' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $customer = new User();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->password = bcrypt($request->password);
        $customer->status = 1;
        $customer->save();
        $customer->assignRole('CUSTOMER');
        return redirect()->route('customers.index')->with('message', 'Customer created successfully');
    }

}
