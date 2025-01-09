<?php

namespace App\Models\Newsletter;

use App\Enums\Newsletter\NewsletterSubsciberStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'is_subscribed'];

    protected $casts = [
        'is_subscribed' => NewsletterSubsciberStatus::class,
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->token = Str::random(60);
        });
    }
}
