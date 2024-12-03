<?php

namespace App\Filters\Customer;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterCustomer implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return $query->where(function ($query) use ($value) {
            /*$query->where('firstname', 'like', '%' . $value . '%')
                ->orWhere('lastname', 'like', '%' . $value . '%');*/

            $query->whereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ['%' . $value . '%']);
        });
    }
}
