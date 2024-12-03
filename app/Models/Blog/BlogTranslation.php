<?php

namespace App\Models\Blog;

use App\Enums\Blog\BlogStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'meta_data',
    ];

    protected $casts = [
        'meta_data' => 'array',
    ];


}
