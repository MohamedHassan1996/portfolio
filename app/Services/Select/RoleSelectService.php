<?php

namespace App\Services\Select;

use Spatie\Permission\Models\Role;

class RoleSelectService
{
    public function getAllRoles()
    {
        return Role::all(['id as value', 'name as label']);
    }
}



