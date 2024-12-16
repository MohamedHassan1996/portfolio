<?php

namespace App\Filters\Newsletter;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterSubscriber implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return $query->where(function ($query) use ($value) {
            $query->where('email', 'like', '%' . $value . '%');
        });
    }
}
