<?php

namespace App\Filters\User;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
    
class FilterUserRole implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        // Custom logic for filtering based on user properties

        /*switch ($property) {
            case 'role':
                // Check if the value is numeric, if so, filter by id, otherwise filter by name
                if (is_numeric($value)) {
                    $query->whereHas('roles', function ($query) use ($value) {
                        $query->where('id', $value);
                    });
                } else {
                    $query->whereHas('roles', function ($query) use ($value) {
                        $query->where('name', 'like', '%' . $value . '%');
                    });
                }
                break;

            // Add other cases for additional filters if needed

            default:
                // Do nothing for unknown properties
        }*/

        $query->whereHas('roles', function ($query) use ($value) {
            $query->where('id', $value);
        });

        return $query;
    }
}
