<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeCredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'stripe_key',
        'stripe_secret',
        'credential_name',
        'status'
    ];
}
