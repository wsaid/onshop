<?php

namespace Domains\Customer\Models;

use App\Traits\HasKey;
use Database\Factories\OrderLineFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory, HasKey;

    protected $fillable = [
        'key',
        'name',
        'description',
        'cost',
        'retail',
        'quantity',
        'purchasable_id',
        'purchasable_type',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function purchasable()
    {
        return $this->morphTo();
    }
    
    protected static function newFactory()
    {
        return OrderLineFactory::new();
    }
}
