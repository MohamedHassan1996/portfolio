<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'dsecription',
        'meta_data',
    ];

    protected $casts = [
        'meta_data' => 'array',
    ];
}
