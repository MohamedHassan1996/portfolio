<?php

namespace App\Services\Select\Company;

use App\Models\Company\Customer;

class CustomerSelectService
{
    public function getAllCustomers()
    {
        return Customer::selectRaw('id as value, CONCAT(firstname, " ", lastname) as label')->get();
    }

    /*public function getAllSubCategories(int $categoryId)
    {
        return Category::select(['id as value', 'name as label'])->where('parent_id', $categoryId)->get();
    }*/

}

