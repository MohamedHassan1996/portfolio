<?php

namespace App\Services\UserRolePremission;

use Illuminate\Contracts\Auth\Authenticatable;
use Spatie\Permission\Models\Permission;


/*class UserPermissionService
{
    public function getUserPermissions(Authenticatable $user)
    {

        $userPermissions = [
            ["permissionName" => 'showAll', 'access' => $user->can('showAll')],
            ["permissionName" => 'create', 'access' => $user->can('createUser')],
            ["permissionName" => 'edit', 'access' => $user->can('editUser')],
            ["permissionName" => 'update', 'access' => $user->can('updateUser')],
            ["permissionName" => 'delete', 'access' => $user->can('deleteUser')],
            ["permissionName" => 'changeStatus', 'access' => $user->can('userStatus')],
        ];

        return [
            'users' => $userPermissions
            'cients' => $clientPermissions
        ];
    }
}*/

class UserPermissionService
{

    /*private array $userPermissions = [];
    private array $clientPermissions = [];
    private array $categoryPermissions = [];
    private array $productPermissions = [];

    public function getUserPermissions(Authenticatable $user)
    {
        $this->userPermissions = $this->generateResourcePermissions($user, [
            'allUsers', 'createUser', 'editUser', 'updateUser', 'deleteUser', 'userStatus'
        ]);

        $this->userPermissions = $this->generateResourcePermissions($user, [
            'allClients', 'createClient', 'editClient', 'updateClient', 'deleteClient', 'clientStatus'
        ]);

        $this->categoryPermissions = $this->generateResourcePermissions($user, [
            'allCategories', 'createCategory', 'editCategory', 'updateCategory', 'deleteCategory', 'createSubCategory', 'editSubCategory', 'updateSubCategory', 'deleteSubCategory'
        ]);

        $this->productPermissions = $this->generateResourcePermissions($user, [
            'createProduct', 'editProduct', 'updateProduct', 'deleteProduct', 'productStatus'
        ]);


        return [
            'users' => $this->userPermissions,
            'clients' => $this->clientPermissions,
            'categories' => $this->categoryPermissions,
            'products' => $this->productPermissions
        ];
    }*/

    public function getUserPermissions(Authenticatable $user)
    {
        $permissions = Permission::all()->pluck('name')->toArray();

        return array_map(function ($permission) use ($user) {
            return [
                'permissionName' => $permission,
                'access' => $user->can($permission)
            ];
        }, $permissions);
    }
}
