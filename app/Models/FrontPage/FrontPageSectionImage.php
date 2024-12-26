<?php

namespace App\Models\FrontPage;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontPageSectionImage extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'front_page_section_id',
        'path',
    ];
}
