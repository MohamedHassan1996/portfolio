<?php

namespace App\Services\Select;

use App\Models\Project\Project;

class ProjectSelectService
{
    public function getAllRoles()
    {
        return Project::all(['id as value', 'name as label']);
    }
}



