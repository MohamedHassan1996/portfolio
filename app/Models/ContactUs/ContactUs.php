<?php

namespace App\Models\ContactUs;

use App\Enums\ContactUs\ContactMessagesStatus;
use App\Enums\ContactUs\SenderType;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory, CreatedUpdatedBy;

    protected $fillable = [
        'name',
        'subject',
        'email',
        'phone',
        'status',
    ];

    protected $casts = [
        'status' => ContactMessagesStatus::class,
    ];

    public function messages()
    {
        return $this->hasMany(ContactUsMessage::class);
    }

    public function getNewMessagesCountAttribute()
    {
        return $this->messages()->where('is_read', null)->where('is_admin', SenderType::class::CUSTOMER)->count();
    }

}
