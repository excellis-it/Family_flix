<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterCms extends Model
{
    use HasFactory;

    public static function footer()
    {
        return FooterCms::first();
    }
}
