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
                'icon' => 'fa-solid fa-phone',
                'title' => 'Call Us',
                'details' => '+ 18453297101',
            ],
            [
                'icon' => 'fa-solid fa-envelope',
                'title' => 'Email Us',
                'details' => 'support@thefamilyflix.com', 
            ],
            [
                'icon' => 'fa-solid fa-location-dot',
                'title' => 'Location',
                'details' => 'Orlando Florida', 
            ],
            [
                'icon' => 'fa-regular fa-clock',
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
