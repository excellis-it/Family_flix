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
            $query = $request->get('query', ''); // Default to empty string if not set
            $wallets = Wallet::query()
                ->where('user_id', Auth::user()->id)
                ->where(function ($q) use ($query) {
                    $q->where('balance', 'like', '%' . $query . '%')
                        ->orWhere('wallet_id', 'like', '%' . $query . '%')                  
                            ->orWhereHas('subscription', function ($q) use ($query) {
                            $q->where('plan_name', 'like', '%' . $query . '%');
                        })
                        ->orWhereHas('subscription', function ($q) use ($query) {
                            $q->where('total', 'like', '%' . $query . '%');
                        })
                        ->orWhereHas('subscription', function ($q) use ($query) {
                            $q->whereHas('customer', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            });
                        });
                    })
                ->paginate(15);
        
            return response()->json(['data' => view('frontend.affiliate-marketer.wallet.filter', compact('wallets'))->render()]);
        }
    }
}
