<?php

namespace App\Services\Select\Company;

use App\Models\Company\Company;

class CompanySelectService
{
    public function getAllCompanies()
    {
        return Company::select(['id as value', 'name as label'])->get();
    }

    /*public function getAllSubCategories(int $categoryId)
    {
        return Category::select(['id as value', 'name as label'])->where('parent_id', $categoryId)->get();
    }*/

}

