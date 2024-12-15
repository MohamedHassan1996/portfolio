<?php

namespace App\Models\Career;

use App\Enums\Career\CareerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Career extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title', 'slug', 'description', 'content', 'extra_details', 'meta_data'];
    protected $fillable = ['is_active'];
    protected $casts = [
        'is_active' => CareerStatus::class,
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(CareerTranslation::class);
    }
}
