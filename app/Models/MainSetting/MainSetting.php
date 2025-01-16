<?php

namespace App\Models\MainSetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'logo',
        'favicon',
    ];

    protected $casts = [
        'content' => 'array'
    ];
}
