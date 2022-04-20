<?php

namespace Domains\Customer\Models;

use App\Traits\HasKey;
use Database\Factories\CouponFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, HasKey;

    protected $fillable = [
        'key',
        'code',
        'reduction',
        'uses',
        'max_uses',
        'active'

    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected static function newFactory()
    {
        return CouponFactory::new();
    }
}
