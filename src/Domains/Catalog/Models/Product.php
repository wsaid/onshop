<?php

namespace Domains\Catalog\Models;

use App\Traits\HasKey;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasKey;

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

    public $casts = [
        'active' => 'boolean'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function range() {
        return $this->belongsTo(Range::class);
    }

    protected static function newFactory()
    {
        return ProductFactory::new();
    }
}
