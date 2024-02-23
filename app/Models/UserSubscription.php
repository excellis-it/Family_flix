<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_details_id',
        'affiliate_id',
        'payment_type',
        'plan_name',
        'plan_price',
        'coupan_code',
        'coupan_discount',
        'coupan_discount_type',
        'sub_total',
        'total',
        'additional_information',
    ];

    public function customerDetails()
    {
        return $this->belongsTo(CustomerDetails::class, 'customer_details_id');
    }

    public function affiliate()
    {
        return $this->belongsTo(User::class, 'affiliate_id');
    }
}
