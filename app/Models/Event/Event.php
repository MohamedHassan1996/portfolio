<?php

namespace App\Models\Event;

use App\Enums\Event\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title', 'description', 'meta_data', 'slug'];

    protected $fillable = [
        'date',
        'time',
        'location',
        'thumbnail',
        'is_published',
    ];

    protected $casts = [
        'is_published' => EventStatus::class,
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ($model->published_at == EventStatus::PUBLISHED) {
                $model->published_at = now();
            }
        });

        static::updating(function ($model) {
            if ($model->published_at == EventStatus::PUBLISHED) {
                $model->published_at = now();
            }
        });


    }

    public function translations(): HasMany
    {
        return $this->hasMany(EventTranslation::class);
    }

}
