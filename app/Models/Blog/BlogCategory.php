<?php

namespace App\Models\Blog;

use App\Enums\Blog\BlogCategoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'slug'];

    protected $fillable = [
        'is_active'
    ];

    protected $casts = [
        'is_active' => BlogCategoryStatus::class
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(BlogCategoryTranslation::class);
    }

    public function blogs(){
        return $this->hasMany(Blog::class, 'category_id');
    }
}
