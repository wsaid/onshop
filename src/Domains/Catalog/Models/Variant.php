<?php

namespace Domains\Catalog\Models;

use App\Traits\HasKey;
use Database\Factories\VariantFactory;
use Domains\Catalog\Builders\VariantBuilder;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\OrderLine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory, HasKey;

    public $resourceType = 'variant';

    protected $fillable = [
        'key',
        'name',
        'cost',
        'retail',
        'height',
        'width',
        'length',
        'weight',
        'active',
        'shippable',
        'product_id'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function newEloquentBuilder($query)
    {
        return new VariantBuilder($query);
    }

    protected static function newFactory()
    {
        return VariantFactory::new();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function purchases()
    {
        return $this->morphMany(CartItem::class, 'purchasable');
    }

    public function orders()
    {
        return $this->morphMany(OrderLine::class, 'purchasable');
    }
}
