<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function subscription()
    {
        return $this->belongsTo(UserSubscription::class,'user_subscription_id');
    }

    
}
