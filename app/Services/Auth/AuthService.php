<?php

namespace App\Services\Auth;

use App\Enums\User\UserStatus;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\UserRolePremission\UserPermissionService;
use Spatie\Permission\Models\Role;

class AuthService
{

    protected $userPermissionService;

    public function __construct(
        UserPermissionService $userPermissionService,
    )
    {
        $this->userPermissionService = $userPermissionService;
    }

    public function register(array $data){
        try {

            $user = User::create([
                'name'=> $data['name'],
                'surname'=> $data['surname'],
                'email'=> $data['email'],
                'password'=> Hash::make($data['password']),
                'gender' => $data['gender'],
                'user_type' => $data['userType'],
            ]);

            return response()->json([
                'message' => 'user has been created!'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }


    public function login(array $data)
    {
        try {

            $userToken = Auth::attempt(['username' => $data['username'], 'password' => $data['password']]);

            if(!$userToken){
                return response()->json([
                    'message' => 'يوجد خطأ فى الاسم او الرقم السرى!',
                ], 401);
            }

            if($userToken && Auth::user()->status == UserStatus::INACTIVE){
                return response()->json([
                    'message' => 'هذا الحساب غير مفعل!',
                ], 401);
            }

            $user = Auth::user();
            $userRoles = $user->getRoleNames();
            $role = Role::findByName($userRoles[0]);
            $roleWithPermissions = $role->permissions;


            return response()->json([
                'token' => $userToken,
                'profile' => new UserResource($user),
                'role' => new RoleResource($role),
                'permissions' => $this->userPermissionService->getUserPermissions($user),
            ], 200)->header('Authorization', $userToken);


        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'you have logged out']);
    }

}
