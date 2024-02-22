<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AffiliateCommission;

class afiliatedCommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $affiliated_commission = new AffiliateCommission();
        $affiliated_commission->percentage = 10;
        $affiliated_commission->save(); 
    }
}
