<?php

namespace Domains\Catalog\Models;

use App\Traits\HasKey;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        return CategoryFactory::new();
    }
}