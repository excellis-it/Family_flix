<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShowCms;

class showCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $showCms = new ShowCms();
        $showCms->heading = 'TV Shows';
        $showCms->small_description = 'Dive into captivating narratives and thrilling adventures with our curated selection of TV shows at The Family Flix – where every episode is a new journey waiting to unfold!';
        $showCms->banner_img = 'show/show-bnr.png';
        $showCms->top_10_show_background = "show/top10watch-bg.png";
        $showCms->save();
    }
}
