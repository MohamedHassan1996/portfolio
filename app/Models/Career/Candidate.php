<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cv',
        'cover_letter',
        'career_id',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
