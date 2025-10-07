<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntertainmentCms extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'image_name',
        'image_alt_tag'
    ];
}
