<?php

namespace App\Services\Select;

use App\Models\User;

class UserSelectService
{
    public function getAllUsers()
    {
        return User::all(['id as value', 'name as label']);
    }

}
