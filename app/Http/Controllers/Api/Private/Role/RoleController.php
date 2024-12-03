<?php

namespace App\Http\Controllers\Api\Private\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\Role\AllRoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Utils\PaginateCollection;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        /*$this->middleware('auth:api');
        $this->middleware('permission:all_countries', ['only' => ['allCountries']]);
        $this->middleware('permission:create_role', ['only' => ['create']]);
        $this->middleware('permission:edit_role', ['only' => ['edit']]);
        $this->middleware('permission:update_role', ['only' => ['update']]);
        $this->middleware('permission:delete_role', ['only' => ['delete']]);*/
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
    */
    public function allRoles(Request $request)
    {
        $allRoles = $this->roleService->allRoles();

        return response()->json(
            new AllRoleCollection(PaginateCollection::paginate($allRoles, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateRoleRequest $createRoleRequest)
    {

        try {
            DB::beginTransaction();

            $this->roleService->createRole($createRoleRequest->validated());

            DB::commit();

            return response()->json([
                'message' => 'new role has been added'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $role  =  $this->roleService->editRole($request->roleId);

        return response()->json(
            new RoleResource($role)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $updateRoleRequest)
    {

        try {
            DB::beginTransaction();
            $this->roleService->updateRole($updateRoleRequest->validated());
            DB::commit();
            return response()->json([
                 'message' => 'تم تحديث بيانات البلد!'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $this->roleService->deleteRole($request->roleId);
            DB::commit();
            return response()->json([
                'message' => 'تم حذف البلد بنجاح!'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }

}
