<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RechargeCodeMail;




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
        $plans = Plan::orderBy('plan_order', 'desc')->get();
        $subscriptions = UserSubscription::where('customer_id', $id)->orderBy('id', 'desc')->paginate(12);
        return view('admin.customer.show-plans', compact('subscriptions','plans','id'));
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

    public function editDetail($id)
    {
        $customer = User::find($id);
        return view('admin.customer.edit', compact('customer'));
    }

    public function updateDetail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'password' => 'nullable|min:8',
            'confirm_password' => 'same:password',
        ]);

        $customer = User::find($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        if($request->password){
            $customer->password = bcrypt($request->password);
        }
        $customer->update();

        return redirect()->route('customers.index')->with('message', 'Customer updated successfully');
    }

    public function rechargeMail($id)
    {
        $user = User::find($id);
        return view('admin.customer.recharge-mail', compact('user'));
    }

    public function rechargeCodeMailSend(Request $request)
    {
        
        $request->validate([
            'mail_content' => 'required',
        ]);

        $user = User::find($request->user_id);
        $maildata = [
            'name' => $user->name,
            'email' => $user->email,
            'mail_content' => $request->mail_content,
        ];

        // Mail::to($user->email)->send(new RechargeCodeMail($maildata));

        return redirect()->route('customers.index')->with('message', 'Recharge code mail sent successfully');
    }

}
