<?php

namespace Domains\Catalog\Models;

use App\Traits\HasKey;
use Database\Factories\RangeFactory;
use Domains\Catalog\Builders\RangeBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory, HasKey;

    public $timestamps = false;

    public $resourceType = 'range';

    protected $fillable = [
        'key',
        'name',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function newEloquentBuilder($query)
    {
        return new RangeBuilder($query);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    protected static function newFactory()
    {
        return RangeFactory::new();
    }
}
