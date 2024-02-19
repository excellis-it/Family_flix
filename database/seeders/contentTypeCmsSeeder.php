<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentTypeCms;

class contentTypeCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $types = [
            [
                'banner_img' => 'show/show-bnr.png',
                'heading' => 'TV Shows',
                'small_description' => 'Dive into captivating narratives and thrilling adventures with our curated selection of TV shows at The Family Flix – where every episode is a new journey waiting to unfold!',
                'top_10_show_background'=> 'show/top10watch-bg.png',
                'popular_show_background' => 'show/popular-show-bg.png',
                'type' => 'show',
            ],
            [
                'banner_img' => 'movie/movie-bg.png',
                'heading' => 'Movies',
                'small_description' => 'Dive into a world of cinematic wonders with our extensive collection of movies. The Family Flix Movie Section is your gateway to a diverse range of films, spanning genres, languages, and cultures. Whether you’re a fan of gripping dramas, thrilling action, heartwarming comedies, or captivating documentaries, we have something for every movie enthusiast.',
                'top_10_show_background'=> 'movie/top10watch-bg.png',
                'popular_show_background' => 'movie/popular-movie-bg.png',
                'type' => 'movie',
            ],
            [
                'banner_img' => 'kids/kids-bnner.png',
                'heading' => 'Kids',
                'small_description' => 'Dive into a magical world of joy and wonder with The Family Flix Kids’ Corner – a curated collection of delightful shows and movies that captivate young hearts and spark imagination.',
                'top_10_show_background'=> 'kids/top10watch-bg.png',
                'popular_show_background' => 'kids/popular-kids-bg.png',
                'type' => 'kid',
            ],
            
        ];

        foreach ($types as $type) {
            ContentTypeCms::create($type);
        }
    }
}
