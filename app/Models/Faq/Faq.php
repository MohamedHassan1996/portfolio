<?php

namespace App\Models\Faq;

use App\Enums\Faq\FaqStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Faq extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $translatedAttributes = ['question', 'answer'];
    protected $fillable = [
        'is_published',
        'order',
    ];

    protected $casts = [
        'is_published' => FaqStatus::class,
    ];
}
