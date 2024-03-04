<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateCommission extends Model
{
    use HasFactory;

    protected $fillable = ['percentage'];

    public function affiliators()
    {
        return $this->hasMany(User::class , 'id');
    }
}
