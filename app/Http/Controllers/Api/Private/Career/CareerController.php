<?php

namespace App\Http\Controllers\Api\Private\Career;

use App\Http\Controllers\Controller;
use App\Http\Requests\Career\CreateCareerRequest;
use App\Http\Requests\Career\UpdateCareerRequest;
use App\Http\Resources\Career\AllCareerCollection;
use App\Http\Resources\Career\CareerResource;
use App\Utils\PaginateCollection;
use App\Services\Career\CareerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CareerController extends Controller
{
    protected $careerService;

    public function __construct(CareerService $careerService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->careerService = $careerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $careers = $this->careerService->allCareers();

        return response()->json(
            new AllCareerCollection(PaginateCollection::paginate($careers, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateCareerRequest $createCareerRequest)
    {

        try {
            DB::beginTransaction();

            $this->careerService->createCareer($createCareerRequest->validated());

            DB::commit();

            return response()->json([
                'message' => __('messages.success.created')
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
        $career  =  $this->careerService->editCareer($request->careerId);

        return response()->json(
            new CareerResource($career)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCareerRequest $updateCareerRequest)
    {

        try {
            DB::beginTransaction();
            $this->careerService->updateCareer($updateCareerRequest->validated());
            DB::commit();
            return response()->json([
                 'message' => __('messages.success.updated')
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
            $this->careerService->deleteCareer($request->careerId);
            DB::commit();
            return response()->json([
                'message' => __('messages.success.deleted')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function changeStatus(Request $request)
    {
        $this->careerService->changeStatus($request->careerId, $request->isPublished);
        return response()->json([
            'message' => __('messages.success.updated')
        ], 200);
    }


}
