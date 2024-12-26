<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontPageSectionTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
