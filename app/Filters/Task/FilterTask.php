<?php

namespace App\Filters\Task;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterTask implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return $query->where(function ($query) use ($value) {
            $query->where('number', 'like', '%' . $value . '%')
                ->orWhere('title', 'like', '%' . $value . '%');
        });
    }
}
