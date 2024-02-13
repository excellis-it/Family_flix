<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TopGrid;

class topGridSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $grids = [
            [
                'icon' => 'grid/grid_icon1.png',
                'title' => 'Unlimited Access',
                'description' => 'Dive into a vast library of movies, TV series, and exclusive content.',
            ],
            [
                'icon' => 'grid/grid_icon2.png',
                'title' => 'Savings Simplified',
                'description' => 'Affordable plans that eliminate the need for multiple subscriptions.',
                
            ],
            [
                'icon' => 'grid/grid_icon3.png',
                'title' => 'Watch Anywhere, Anytime',
                'description' => 'Enjoy your favorites on your terms - mobile, desktop, or TV.',
            ],
        ];

        foreach ($grids as $grid) {
            TopGrid::create($grid);
        }
    }
}

