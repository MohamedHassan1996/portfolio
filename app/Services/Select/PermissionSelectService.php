<?php

namespace App\Services\Select;

use Spatie\Permission\Models\Permission;

class PermissionSelectService
{
    public function getAllPermissions()
    {
        return Permission::all(['name as value', 'name as label']);
    }
}



