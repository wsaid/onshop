<?php

namespace Domains\Customer\Models;

use Database\Factories\AddressFactory;
use Domains\Customer\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'billing',
        'user_id',
        'location_id'
    ];

    protected $casts = [
        'billing' => 'boolean',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    protected static function newFactory()
    {
        return AddressFactory::new();
    }
}
