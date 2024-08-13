<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class BalanceAddSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallet_group_by_user = Wallet::select('user_id')->groupBy('user_id')->get();
        foreach ($wallet_group_by_user as $key => $value) {
            if ($value->user_id == null) {
                $user_id = User::role('ADMIN')->orderBy('id', 'desc')->first()->id;
                User::where('id', $user_id)->update(['wallet_balance' => Wallet::where('user_id', $user_id)->sum('balance')]);
            } else {
                User::where('id', $value->user_id)->update(['wallet_balance' => Wallet::where('user_id', $value->user_id)->sum('amount')]);
            }

        }
    }
}
