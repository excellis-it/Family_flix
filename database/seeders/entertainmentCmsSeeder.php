<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntertainmentCms;

class entertainmentCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $entertainments = [
            [
    
                'image' => 'entertainment/en-1.png',
                'image_name' => 'On Your TV',
            ],
            [
                'image' => 'entertainment/en-2.png',
                'image_name' => 'Mobiles & Tablets',
                
            ],
            [
                'image' => 'entertainment/en-3.png',
                'image_name' => 'On Firestick & Firecube',
                
            ],
        ];

        foreach ($entertainments as $entertainment) {
            EntertainmentCms::create($entertainment);
        }
    }
}
