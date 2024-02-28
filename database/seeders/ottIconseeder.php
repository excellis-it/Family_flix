<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OttService;

class ottIconseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $icons = [
            [
                'icon' => 'ott_icon/icon1.png',
            ],
            [
                'icon' => 'ott_icon/icon2.png',
            ],
            [
                'icon' => 'ott_icon/icon3.png',
            ],
            [
                'icon' => 'ott_icon/icon4.png',
            ],
            [
                'icon' => 'ott_icon/icon5.png',
            ],
            [
                'icon' => 'ott_icon/icon6.png',
            ],
            [
                'icon' => 'ott_icon/icon11.png',
            ],
            [
                'icon' => 'ott_icon/icon8.png',
            ],
        ];

        foreach ($icons as $icon) {
            OttService::create($icon);
        }
    }
}
