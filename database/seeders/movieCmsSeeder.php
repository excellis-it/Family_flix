<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MovieCms;

class movieCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $movieCms = new MovieCms();
        $movieCms->heading = 'Movies';
        $movieCms->small_description = 'Dive into a world of cinematic wonders with our extensive collection of movies. The Family Flix Movie Section is your gateway to a diverse range of films, spanning genres, languages, and cultures. Whether you’re a fan of gripping dramas, thrilling action, heartwarming comedies, or captivating documentaries, we have something for every movie enthusiast.';
        $movieCms->banner_img = 'movie/movie-bg.png';
        $movieCms->top10_show_back_img = "movie/top10watch-bg.png";
        $movieCms-> popular_movie_background = "movie/popular-movie-bg.png";
        $movieCms->save();
    }
}
