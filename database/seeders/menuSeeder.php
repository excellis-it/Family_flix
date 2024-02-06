<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class menuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menus = [
            [
                'title' => 'Header Menu',
                'parent_id' => 0,
                'slug' => 'header-menu',
            ],
            [
                'title' => 'Quick Links',
                'parent_id' => 0,
                'slug' => 'quick-links',
                
            ],
            [
                'title' => 'Customer Support',
                'parent_id' => 0,
                'slug' => 'customer-support',
                
            ],
            [
                'title' => 'Contact Us',
                'parent_id' => 0,
                'slug' => 'contact-us',
               
            ],
            [
                'title' => 'Home',
                'parent_id' => 1,
                'slug' => 'home',
                
            ],
            [
                'title' => 'Shows',
                'parent_id' => 1,
                'slug' => 'shows',
               
            ],
            [
                'title' => 'Movies',
                'parent_id' => 1,
                'slug' => 'movies',
                
            ],
            [
                'title' => 'Kids',
                'parent_id' => 1,
                'slug' => 'kids',
                
            ],
            [
                'title' => 'Pricing',
                'parent_id' => 1,
                'slug' => 'pricing',
                
            ],
            [
                'title' => 'About Us',
                'parent_id' => 1,
                'slug' => 'about-us',
                
            ],
            [
                'title' => 'Contact',
                'parent_id' => 1,
                'slug' => 'contact',
                
            ],
            
            [
                'title' => 'Home',
                'parent_id' => 2,
                'slug' => 'home',
                
            ],
            [
                'title' => 'Shows',
                'parent_id' => 2,
                'slug' => 'shows',
                
            ],
            [
                'title' => 'Movies',
                'parent_id' => 2,
                'slug' => 'movies',
               
            ],
            [
                'title' => 'Kids',
                'parent_id' => 2,
                'slug' => 'kids',
                
            ],
            [
                'title' => 'Faq',
                'parent_id' => 3,
                'slug' => 'faq',
                
            ],
            [
                'title' => 'Contact',
                'parent_id' => 3,
                'slug' => 'contact',
                
            ],
            [
                'title' => 'Terms of service',
                'parent_id' => 3,
                'slug' => 'term-of-service',
                
            ],
            [
                'title' => '+18453297101',
                'parent_id' => 4,
                'slug' => '',
                
            ],
            [
                'title' => 'support@thefamilyflix.com',
                'parent_id' => 4,
                'slug' => '',
                
            ],
            [
                'title' => 'Orlando Florida',
                'parent_id' => 4,
                'slug' => '',
                
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
