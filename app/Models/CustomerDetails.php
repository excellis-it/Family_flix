<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_address',
        'first_name',
        'last_name',
        'country',
        'house_no_street_name',
        'apartment',
        'town',
        'state',
        'post_code',
        'phone',
    ];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
