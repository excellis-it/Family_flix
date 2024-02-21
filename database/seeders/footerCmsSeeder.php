<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterCms;

class footerCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $footer_cms = new FooterCms();
        $footer_cms->footer_logo = 'footer/logo_1.png';
        $footer_cms->footer_image = 'footer/logo_2.png';
        $footer_cms->footer_background = 'footer/footer-bg.png';
        $footer_cms->save();
       
    }
}
