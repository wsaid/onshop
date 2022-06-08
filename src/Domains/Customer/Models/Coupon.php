<?php

namespace Domains\Customer\Models;

use App\Traits\HasUuid;
use Database\Factories\CouponFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
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
