<?php

namespace App\Models\ContactUs;

use App\Enums\ContactUs\SenderType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'is_read',
        'is_admin',
        'contact_us_Id',
    ];

    protected $casts = [
        'is_admin' => SenderType::class
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
