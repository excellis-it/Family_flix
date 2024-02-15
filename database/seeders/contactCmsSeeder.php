<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUsCms;


class contactCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        ContactUsCms::create([
            'title' => 'Contact',
            'banner_img' => 'contact/contact-banner.png',
            'background_img' => 'contact/contact-bg.png',
            'main_title' => 'Connect With Us',
            'short_title' => 'To learn more about how Streamit can help you, contact us.',
            'button_name' => 'Contact Us',
            'map_link' => 'https://maps.google.com/maps?q=Orlando%2C%20Florida&t=m&z=15&output=embed&iwloc=near',
        ]);
    }
}
