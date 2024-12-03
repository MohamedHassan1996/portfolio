<?php

namespace App\Filters\Project;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Support\Facades\Auth;

class FilterEmployee implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        $user = Auth::user();

        // If the user is a superAdmin, filter by multiple user_ids
        if ($user->roles->contains('name', 'superAdmin')) {
            // Assuming $value is a comma-separated list of user IDs (e.g., "1,2,3")
            $userIds = explode(',', $value);

            // Filter projects by the list of user IDs in the employees relationship
            return $query->whereHas('employees', function ($q) use ($userIds) {
                $q->whereIn('user_id', $userIds);
            });
        } else {
            // If the user is not a superAdmin, filter by the authenticated user's user_id
            return $query->whereHas('employees', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
    }
}
