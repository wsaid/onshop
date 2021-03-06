<?php

namespace Domains\Customer\Models;

use App\Traits\HasUuid;
use Database\Factories\CartItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'quantity',
        'purchasable_id',
        'purchasable_type',
        'cart_id'
    ];

    public function purchasable()
    {
        return $this->morphTo();
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    protected static function newFactory()
    {
        return CartItemFactory::new();
    }
}
