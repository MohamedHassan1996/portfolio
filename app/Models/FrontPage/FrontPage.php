<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FrontPage extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title', 'slug', 'meta_data'];

    protected $fillable = [
        'is_active',
        'controller_name',
    ];

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(FrontPageSection::class, 'page_sections', 'front_page_id', 'front_page_section_id');
    }

}
