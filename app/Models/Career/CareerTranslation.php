<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'slug',
        'extra_details',
        'dsecription',
        'meta_data',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'extra_details' => 'array',
    ];
}
