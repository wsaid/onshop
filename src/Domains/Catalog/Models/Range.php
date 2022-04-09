<?php

namespace Domains\Catalog\Models;

use App\Traits\HasKey;
use Database\Factories\RangeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Range extends Model
{
    use HasFactory, HasKey;

    public $timestamps = false;

    protected $fillable = [
        'key',
        'name',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected static function newFactory()
    {
        return RangeFactory::new();
    }
}
