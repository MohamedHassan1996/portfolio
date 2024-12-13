<?php

namespace App\Services\Select;

use App\Models\Blog\BlogCategoryTranslation;

class BlogCategorySelectService
{
    public function getAllBlogCategories()
    {
        $locale = app()->getLocale();
        return BlogCategoryTranslation::where('locale', $locale)->get(['blog_category_id as value', 'name as label']);
    }
}



