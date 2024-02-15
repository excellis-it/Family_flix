<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class socialMediaCms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $socialMedia = [
            [
                'icon' => 'fa-brands fa-facebook',
                'link' => 'https://www.facebook.com/',
            ],
            [
                'icon' => 'fa-brands fa-instagram',
                'link' => 'https://twitter.com/',
            ] 
        ];

        foreach ($socialMedia as $media) {
            SocialMedia::create(array(
                'icon' => $media['icon'],
                'link' => $media['link'],
            ));
        }
    }
}
