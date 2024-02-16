<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KidsCms;

class kidsCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kidsCms = new KidsCms();
        $kidsCms->heading = 'Kids';
        $kidsCms->small_description = 'Dive into a magical world of joy and wonder with The Family Flix Kids’ Corner – a curated collection of delightful shows and movies that captivate young hearts and spark imagination.';
        $kidsCms->banner_img = 'kids/kids-bnner.png';
        $kidsCms->top_10_show_background = "kids/top10watch-bg.png";
        $kidsCms->popular_kids_background = "kids/popular-kids-bg.png";
        $kidsCms->save();
    }
}
