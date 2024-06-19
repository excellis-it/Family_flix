<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    //

    public function walletList()
    {
        $wallets = Wallet::where('user_type', 'admin')->paginate(10);
        return view('admin.wallet.list')->with(compact('wallets'));
    }
}
