<?php

namespace App\Models\Product;

use App\Enums\Product\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translatedAttributes = ['name', 'description', 'slug', 'content', 'meta_data'];

    protected $fillable = ['is_active'];

    protected $casts = [
        'is_active' => ProductStatus::class,
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function firstImage()
    {
        return $this->hasOne(ProductImage::class)->latest();
    }
}
