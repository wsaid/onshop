<?php

namespace Domains\Customer\Models;

use App\Traits\HasKey;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasKey;

    protected $fillable = [
        'key',
        'number',
        'status',
        'cuopon',
        'total',
        'reduction',
        'user_id',
        'shipping_id',
        'billing_id',
        'completed_at',
        'cancelled_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Location::class, 'shipping_id');
    }

    public function billing()
    {
        return $this->belongsTo(Location::class, 'billing_id');
    }

    public function items()
    {
        return $this->hasMany(OrderLine::class);
    }

    protected static function newFactory()
    {
        return OrderFactory::new();
    }
}
