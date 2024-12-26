<?php

namespace App\Http\Controllers\Api\Private\FrontPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPage\FrontPageSection\CreateFrontPageSectionRequest;
use App\Http\Requests\FrontPage\FrontPageSection\UpdateFrontPageSectionRequest;
use App\Http\Resources\FrontPage\FrontPageResource;
use App\Http\Resources\FrontPage\FrontPageSection\FrontPageSectionResource;
use App\Services\FrontPage\FrontPageSectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FrontPageSectionController extends Controller
{
    protected $frontPageSectionService;

    public function __construct(FrontPageSectionService $frontPageSectionService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->frontPageSectionService = $frontPageSectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $frontPages = $this->frontPageSectionService->allFrontPageSections($request->all());

        return response()->json(
            FrontPageSectionResource::collection($frontPages)
        );

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateFrontPageSectionRequest $createFrontPageSectionRequest)
    {

        try {
            DB::beginTransaction();

            $this->frontPageSectionService->createFrontPageSection($createFrontPageSectionRequest->validated());

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
        $frontPage  =  $this->frontPageSectionService->editFrontPageSection($request->frontPageSectionId);

        return response()->json(
            new FrontPageSectionResource($frontPage)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFrontPageSectionRequest $updateFrontPageSectionRequest)
    {

        try {
            DB::beginTransaction();
            $this->frontPageSectionService->updateFrontPageSection($updateFrontPageSectionRequest->validated());
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
            $this->frontPageSectionService->deleteFrontPageSection($request->frontPageSectionId);
            DB::commit();
            return response()->json([
                'message' => __('messages.success.deleted')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

}
