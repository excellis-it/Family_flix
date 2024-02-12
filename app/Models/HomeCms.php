<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCms extends Model
{
    use HasFactory;

    protected $fillable=[
        'top_short_title',
        'top_main_title',
        'top_button_text',
        'section2_title',
        'section2_description',
        'section2_short_title',
        'section3_title',
        'section3_video_link',
        'section4_title',
        'section4_description',
        'section5_main_title',
        'section5_main_description',
        'plan_section_title'
    ];


     
}
