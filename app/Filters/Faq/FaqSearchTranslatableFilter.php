<?php

namespace App\Filters\Faq;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FaqSearchTranslatableFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where(function ($query) use ($property, $value) {
            foreach (config('app.available_locales', ['en', 'ar']) as $locale) {
                $query->orWhereTranslationLike('question', "%{$value}%", $locale);
            }
        });
    }
}
