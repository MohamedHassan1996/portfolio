<?php

namespace App\Services\Role;

use Spatie\Permission\Models\Role;

class RoleService{

    public function allRoles()
    {
        $roles = Role::all();

        return $roles;

    }

    public function createRole(array $roleData): Role
    {

        $role = Role::create([
            'name' => $roleData['name'],
            'guard_name' => 'api',
        ]);

        if(isset($roleData['permissions'])){
            $role->givePermissionTo($roleData['permissions']);
        }

        return $role;
    }

    public function editRole(int $roleId)
    {
        return Role::with('permissions')->find($roleId);
    }

    public function updateRole(array $roleData): Role
    {

        $role = Role::find($roleData['roleId']);

        $role->update([
            'name' => $roleData['name']
        ]);

        $role->syncPermissions();

        if(isset($roleData['permissions'])){
            $role->givePermissionTo($roleData['permissions']);
        }

        return $role;

    }


    public function deleteRole(int $roleId)
    {
        $role = Role::find($roleId);

        $role->delete();

    }

}
