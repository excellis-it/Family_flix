<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeaderMenu;

class headerMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'Home',
            ],
            [
                'name' => 'About',
            ],
            [
                'name' => 'Product',
            ],
            [
                'name' => 'Contact',
            ],
            
        ]; 

        foreach ($menus as $key => $menu) {
            HeaderMenu::create($menu);
        }
    }
}
