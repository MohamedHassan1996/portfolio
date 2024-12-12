<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'content',
        'description',
        'slug',
        'meta_data'
    ];

    protected $casts = [
        'meta_data' => 'array'
    ];
}
