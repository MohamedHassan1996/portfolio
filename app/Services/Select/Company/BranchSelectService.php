<?php

namespace App\Services\Select\Company;

use App\Models\Company\Branch;

class BranchSelectService
{
    public function getAllBranches(int $companyId)
    {
        return Branch::select(['id as value', 'name as label'])->where('company_id', $companyId)->get();
    }

    /*public function getAllSubCategories(int $categoryId)
    {
        return Category::select(['id as value', 'name as label'])->where('parent_id', $categoryId)->get();
    }*/

}

