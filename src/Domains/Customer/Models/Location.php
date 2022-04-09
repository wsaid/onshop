<?php

namespace Domains\Customer\Models;

use App\Traits\HasUuid;
use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory, HasUuid;

    public function address() {
        return $this->hasOne(Address::class);
    }

    protected static function newFactory()
    {
        return LocationFactory::new();
    }
}
