<?php

namespace Domains\Customer\Models;

use App\Traits\HasUuid;
use Database\Factories\CartFactory;
use Domains\Customer\Enums\CartStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, HasUuid;

    public $resourceType = 'cart';

    protected $fillable = [
        'uuid',
        'status',
        'total',
        'coupon',
        'reduction',
        'user_id'
    ];

    protected $casts = [
        'status' => CartStatus::class . ':nullable',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    protected static function newFactory()
    {
        return CartFactory::new();
    }
}
