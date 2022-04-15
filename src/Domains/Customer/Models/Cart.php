<?php

namespace Domains\Customer\Models;

use App\Traits\HasKey;
use Database\Factories\CartFactory;
use Domains\Customer\Enums\CartStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, HasKey;

    protected $fillable = [
        'key',
        'status',
        'total',
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

    protected static function newFactory()
    {
        return CartFactory::new();
    }
}
