<?php

namespace App\Filters\Product;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ProductCategorySearchTranslatableFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where(function ($query) use ($property, $value) {
            foreach (config('app.available_locales', ['en', 'ar']) as $locale) {
                $query->orWhereTranslationLike('name', "%{$value}%", $locale);
            }
        });
    }
}
