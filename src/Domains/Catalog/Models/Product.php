<?php

namespace Domains\Catalog\Models;

use App\Traits\HasKey;
use Database\Factories\ProductFactory;
use Domains\Catalog\Builders\ProductBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasKey;

    public $resourceType = 'product';
    
    protected $fillable = [
        'key',
        'name',
        'description',
        'cost',
        'retail',
        'active',
        'vat',
        'category_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function newEloquentBuilder($query)
    {
        return new ProductBuilder($query);
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function range() {
        return $this->belongsTo(Range::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
