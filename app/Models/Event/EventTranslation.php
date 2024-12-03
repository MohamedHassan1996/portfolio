<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = ['title', 'description', 'meta_data', 'slug'];

    protected $casts = [
        'meta_data' => 'array',
    ];

}
