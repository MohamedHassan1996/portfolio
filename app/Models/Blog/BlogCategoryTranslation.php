<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogCategoryTranslation extends Model
{
    use HasFactory;

    protected $table = 'blog_categories_translations';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
    ];

}
