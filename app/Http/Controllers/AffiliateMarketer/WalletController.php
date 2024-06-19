<?php

namespace App\Http\Controllers\AffiliateMarketer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;


class WalletController extends Controller
{
    //

    public function walletList()
    {
        $wallets = Wallet::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(15);
        return view('frontend.affiliate-marketer.wallet.list')->with(compact('wallets'));
    }

    public function walletFetchData(Request $request)
    {
       
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $wallets = Wallet::where('user_id', Auth::user()->id)
                ->orWhere('amount', 'like', '%' . $query . '%')
                ->orWhere('transaction_id', 'like', '%' . $query . '%')
                ->orWhere('created_at', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(15);

            return response()->json(['data' => view('frontend.affiliate-marketer.wallet.filter', compact('wallets'))->render()]);
        }
    }
}
