<?php

namespace App\Models\Product;

use App\Enums\Product\ProductCategoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class ProductCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translatedAttributes = ['name'];

    protected $fillable = ['is_active', 'image'];

    protected $casts = [
        'is_active' => ProductCategoryStatus::class,
    ];

}
