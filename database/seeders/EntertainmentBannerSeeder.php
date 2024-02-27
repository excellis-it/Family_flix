<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntertainmentBanner;

class EntertainmentBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $banners = [
            [
                'banner_image' => 'entertainment_banner/show-banner1.png',
                'banner_logo' => 'entertainment_banner/show-bnr-logo1.png',
                'rating' => 4,
                'small_text' => '6 Seasons / 22 mins / 1990-1996',
                'long_description' => 'The affluent Banks family finds their lives turned upside down when street-smart Will, a Philadelphia relative, moves into their Bel-Air mansion',
                'button_name' => 'Subscribe',
                'banner_type' => 'Shows',
            ],
            [
                'banner_image' => 'entertainment_banner/show-banner2.png',
                'banner_logo' => 'entertainment_banner/show-bnr-logo3.png',
                'rating' => 4,
                'small_text' => '1hr : 42mins / January 2024',
                'long_description' => 'Based on Caroline Kepnes best-selling novel of the same name, YOU is a 21st century love story that asks, "What would you do for love?" When a brilliant bookstore manager crosses paths with an aspiring writer, his answer becomes clear: anything. Using the internet and social media as his tools to gather the most intimate of details and get close to her, a charming and awkward crush quickly becomes obsession as he quietly and strategically removes every obstacle - and person - in his way.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Shows',
            ],
            [
                'banner_image' => 'entertainment_banner/show-banner3.png',
                'banner_logo' => 'entertainment_banner/show-bnr-logo2.png',
                'rating' => 5,
                'small_text' => '1hr : 42mins / January 2024',
                'long_description' => 'Thomas Shelby and his brothers return to Birmingham after serving in the British Army during WWI. Shelby and his gang, the Peaky Blinders, control the city of Birmingham. However, Shelbys ambitions extend beyond Birmingham, as he plans to build on the business empire he is created, and dispatch anyone who gets in his way.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Shows',
            ],
            [
                'banner_image' => 'entertainment_banner/movie-bnr1.png',
                'banner_logo' => 'entertainment_banner/movie-bnr-logo1.png',
                'rating' => 4,
                'small_text' => '1hr : 42mins / January 2024',
                'long_description' => 'M3GAN is a marvel of artificial intelligence, a lifelike doll that is programmed to be a child is greatest companion and a parents greatest ally. Designed by Gemma, a brilliant roboticist, M3GAN can listen, watch and learn as it plays the role of friend and teacher, playmate and protector. When Gemma becomes the unexpected caretaker of her 8-year-old niece, she decides to give the girl an M3GAN prototype, a decision that leads to unimaginable consequences.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Movies',
            ],
            [
                'banner_image' => 'entertainment_banner/movie-bnr1.png',
                'banner_logo' => 'entertainment_banner/movie-bnr-logo1.png',
                'rating' => 4,
                'small_text' => '1hr : 42mins / January 2024',
                'long_description' => 'M3GAN is a marvel of artificial intelligence, a lifelike doll that is programmed to be a child is greatest companion and a parents greatest ally. Designed by Gemma, a brilliant roboticist, M3GAN can listen, watch and learn as it plays the role of friend and teacher, playmate and protector. When Gemma becomes the unexpected caretaker of her 8-year-old niece, she decides to give the girl an M3GAN prototype, a decision that leads to unimaginable consequences.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Movies',
            ],
            [
                'banner_image' => 'entertainment_banner/movie-bnr1.png',
                'banner_logo' => 'entertainment_banner/movie-bnr-logo1.png',
                'rating' => 4,
                'small_text' => '1hr : 42mins / January 2024',
                'long_description' => 'M3GAN is a marvel of artificial intelligence, a lifelike doll that is programmed to be a child is greatest companion and a parents greatest ally. Designed by Gemma, a brilliant roboticist, M3GAN can listen, watch and learn as it plays the role of friend and teacher, playmate and protector. When Gemma becomes the unexpected caretaker of her 8-year-old niece, she decides to give the girl an M3GAN prototype, a decision that leads to unimaginable consequences.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Movies',
            ],
            [
                'banner_image' => 'entertainment_banner/kids-bannr1.png',
                'banner_logo' => 'entertainment_banner/kids-banner-logo1.png',
                'rating' => 4,
                'small_text' => '1hr : 47mins / 2017',
                'long_description' => 'Despite his familys baffling generations-old ban on music, Miguel dreams of becoming an accomplished musician like his idol, Ernesto de la Cruz. Desperate to prove his talent, Miguel finds himself in the stunning and colorful Land of the Dead following a mysterious chain of events. Along the way, he meets charming trickster Hector, and together, they set off on an extraordinary journey to unlock the real story behind Miguels family history.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Kids',
            ],
            [
                'banner_image' => 'entertainment_banner/kids-bannr2.png',
                'banner_logo' => 'entertainment_banner/kids-bnnr-logo2.png',
                'rating' => 4,
                'small_text' => '1hr : 42mins / January 2023',
                'long_description' => 'Frustrated with her thankless office job, the 25-year-old red panda copes with her daily struggles by belting out heavy metal karaoke after work.',
                'button_name' => 'Subscribe',
                'banner_type' => 'Kids',
            ],
            [
                'banner_image' => 'entertainment_banner/kids-banner3.png',
                'banner_logo' => 'entertainment_banner/kids-bnnr-logo3.png',
                'rating' => 4,
                'small_text' => '30 mins / 2003 - 2006',
                'long_description' => 'In a major city, Robin the Boy Wonder leads his own team of superheroes, The Teen Titans. With his teammates, the dark Raven, the powerful Cyborg, the flighty alien princess Starfire and the flippant Beast Boy; the team battles the forces of evil where ever they appear like the enigmatic Slade, the diabolical Brother Blood or the malevolently cosmic Trigon',
                'button_name' => 'Subscribe',
                'banner_type' => 'Kids',
            ],

        ];

        foreach ($banners as $banner) {
            EntertainmentBanner::create(array(
                'banner_image' => $banner['banner_image'],
                'banner_logo' => $banner['banner_logo'],
                'rating' => $banner['rating'],
                'small_text' => $banner['small_text'],
                'long_description' => $banner['long_description'],
                'button_name' => $banner['button_name'],
                'banner_type' => $banner['banner_type'],

            ));
        }



    }
}
