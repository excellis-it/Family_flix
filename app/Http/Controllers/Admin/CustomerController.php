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
use App\Models\EmailTemplate;

class CustomerController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->can('Manage Customer')) {
            $customers = User::with('userLastSubscription')->role('CUSTOMER')->orderBy('id', 'desc')->paginate(10);
            // dd($customers);
            return view('admin.customer.list', compact('customers'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customerAjaxList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $limit = $request->get('limit', 10); // Default to 15 if no limit is provided

            $customers = User::role('CUSTOMER')
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('id', 'like', '%' . $query . '%')
                        ->orWhere('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->orWhere('phone', 'like', '%' . $query . '%');
                })
                ->with('userLastSubscription')
                ->orderBy('id', 'desc')
                ->paginate($limit); // Use the limit here

            return response()->json(['data' => view('admin.customer.table', compact('customers'))->render()]);
        }
    }


    public function showPlans($id)
    {
        $plans = Plan::orderBy('plan_order', 'desc')->get();
        $subscriptions = UserSubscription::where('customer_id', $id)->orderBy('id', 'desc')->paginate(12);
        return view('admin.customer.show-plans', compact('subscriptions', 'plans', 'id'));
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
        if ($request->password) {
            $customer->password = bcrypt($request->password);
        }
        $customer->update();

        return redirect()->route('customers.index')->with('message', 'Customer updated successfully');
    }

    public function rechargeMail($id)
    {
        $user = User::find($id);
        $emails = EmailTemplate::orderBy('name', 'asc')->get();
        return view('admin.customer.recharge-mail', compact('user', 'emails'));
    }

    public function rechargeCodeMailSend(Request $request)
    {
        $request->validate([
            'email_id' => 'required|exists:email_templates,id',
            'login_information' => 'required_if:email_id,1',
            'account_number' => 'required_if:email_id,1',
            'company_name' => 'required_if:email_id,1|required_if:email_id,2',
            'password' => 'required_if:email_id,1',
            'rental_code' => 'required_if:email_id,2',
        ], [
            'email_id.required' => 'The email template field is required.',
            'email_id.exists' => 'The selected email template is invalid.',
            'login_information.required_if' => 'The login information is required when email template 1 is selected.',
            'account_number.required_if' => 'The account number is required when email template 1 is selected.',
            'company_name.required_if' => 'The company name is required when email template 1 or 2 is selected.',
            'password.required_if' => 'The password is required when email template 1 is selected.',
            'rental_code.required_if' => 'The rental code is required when email template 2 is selected.',
        ]);



        $user = User::findOrFail($request->user_id);
        $emailTemplate = EmailTemplate::findOrFail($request->email_id);

        // Prepare dynamic data
        $maildata = [
            'name' => $user->name,
            'email' => $user->email,
            'login_information' => $request->login_information,
            'account_number' => $request->account_number,
            'password' => $request->password,
            'company_name' => $request->company_name,
            'subject' => $emailTemplate->subject,
            'title' =>  $emailTemplate->title,
        ];

        if ($request->email_id == 1) {
            $maildata['mail_content'] = str_replace(
                ['{customer_name}', '{login_information}', '{account_number}', '{password}', '{company_name}'],
                [$maildata['name'], $maildata['login_information'], $maildata['account_number'], $maildata['password'], $maildata['company_name']],
                $emailTemplate->content
            );
        } else {
            $maildata['mail_content'] = str_replace(
                ['{customer_name}', '{rental_code}',  '{company_name}'],
                [$maildata['name'], $request->rental_code, $maildata['company_name']],
                $emailTemplate->content
            );
        }
        // Replace placeholders in the email content with actual data


        // Send the email
        Mail::to($user->email)->send(new RechargeCodeMail($maildata));

        return redirect()->route('customers.index')->with('message', 'Recharge code mail sent successfully');
    }

    public function deleteDetail($id)
    {
        $customer = User::find($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('message', 'Customer deleted successfully');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No customers selected']);
        }

        try {
            User::whereIn('id', $ids)->delete();

            return response()->json(['success' => true, 'message' => 'Selected customers deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete customers']);
        }
    }
}
