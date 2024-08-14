<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletMoneyTransaction;

class WalletController extends Controller
{
    //

    public function walletList()
    {
        $wallets = Wallet::where('user_type', 'admin')->orderBy('id','desc')->paginate(10);
        return view('admin.wallet.list')->with(compact('wallets'));
    }

    public function walletFetchData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query', ''); // Default to empty string if not set
            $wallets = Wallet::query()
                ->where('user_type', 'admin')
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
                    ->orderBy('id','desc')
                ->paginate(10);

            return response()->json(['data' => view('admin.wallet.filter', compact('wallets'))->render()]);
        }
    }

    public function adminWalletMoneyTransferList()
    {
        $wallet_money_transfer = WalletMoneyTransaction::orderBy('id', 'desc')->paginate(15);
        return view('admin.wallet.money_transfer_list')->with(compact('wallet_money_transfer'));
    }
}
