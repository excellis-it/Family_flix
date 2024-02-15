<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactDetails;

class contactDetailsCms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $details = [
            [
                'icon' => 'contact/cont-icon1.png',
                'title' => 'Call Us',
                'details' => '+ 18453297101',
            ],
            [
                'icon' => 'contact/cont-icon2.png',
                'title' => 'Email Us',
                'details' => 'support@thefamilyflix.com', 
            ],
            [
                'icon' => 'contact/cont-icon3.png',
                'title' => 'Location',
                'details' => 'Orlando Florida', 
            ],
            [
                'icon' => 'contact/cont-icon4.png',
                'title' => 'Office Hours (Closed Saturday)',
                'details' => '9am-11pm', 
            ],
        ];


        foreach ($details as $detail) {
            ContactDetails::create(array(
                'icon' => $detail['icon'],
                'title' => $detail['title'],
                'details' => $detail['details'],
            ));
        }
    }
}
