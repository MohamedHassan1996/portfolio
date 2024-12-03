<?php

namespace App\Services\Select\Parameter;

use App\Models\Parameter\parameterValue;

class ParameterSelectService
{
    public function getAllParameters(int $parameterId)
    {
        return parameterValue::select(['id as value', 'parameter_value as label'])->where('parameter_id', $parameterId)->get();
    }

    /*public function getAllSubCategories(int $categoryId)
    {
        return Category::select(['id as value', 'name as label'])->where('parent_id', $categoryId)->get();
    }*/

}

