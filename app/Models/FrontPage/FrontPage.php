<?php

namespace App\Models\FrontPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class FrontPage extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title', 'slug', 'meta_data'];

    protected $fillable = [
        'is_active',
    ];

    public function sections()
    {
        return $this->hasMany(FrontPageSection::class, 'front_page_id');
    }

}
