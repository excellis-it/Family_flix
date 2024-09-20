<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StripeCredential;

class StripeCredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credentials = StripeCredential::orderBy('id', 'desc')->get();
        return view('admin.site_settings.paypal_credential.list', compact('credentials'));
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $credentials = StripeCredential::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('stripe_key', 'like', '%' . $query . '%')
                    ->orWhere('stripe_secret', 'like', '%' . $query . '%')
                    ->orWhere('credential_name', 'like', '%' . $query . '%');
            })
            ->orderBy('id', 'desc')
            ->get();

            return response()->json(['data' => view('admin.site_settings.paypal_credential.filter', compact('credentials'))->render()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $credential = StripeCredential::find($id);
        return view('admin.site_settings.paypal_credential.edit', compact('credential'));
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
            'stripe_key' => 'required',
            'stripe_secret' => 'required',
            'status' => 'required',
        ]);

        $credential = StripeCredential::find($id);
        $credential->stripe_key = $request->stripe_key;
        $credential->stripe_secret = $request->stripe_secret;
        $credential->status = $request->status;
        $credential->update();

        if ($request->status == 1) {
            $credentials = StripeCredential::where('id', '!=', $id)->get();
            foreach ($credentials as $credential) {
                $credential->status = 0;
                $credential->update();
            }
        } else {
            $credentials = StripeCredential::where('id', '!=', $id)->get();
            foreach ($credentials as $credential) {
                $credential->status = 1;
                $credential->update();
                break;
            }
        }

        return redirect()->route('credentials.index')->with('message', 'Stripe Credential Updated Successfully');
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
