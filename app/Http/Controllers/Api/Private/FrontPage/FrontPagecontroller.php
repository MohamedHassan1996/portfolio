<?php

namespace App\Http\Controllers\Api\Private\FrontPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPage\CreateFrontPageRequest;
use App\Http\Requests\FrontPage\UpdateFrontPageRequest;
use App\Http\Resources\FrontPage\AllFrontPageCollection;
use App\Http\Resources\FrontPage\FrontPageResource;
use App\Utils\PaginateCollection;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FrontPagecontroller extends Controller
{
    protected $frontPageService;

    public function __construct(FrontPageService $frontPageService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->frontPageService = $frontPageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $frontPages = $this->frontPageService->allFrontPages();

        return response()->json(
            new AllFrontPageCollection(PaginateCollection::paginate($frontPages, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateFrontPageRequest $createFrontPageRequest)
    {

        try {
            DB::beginTransaction();

            $this->frontPageService->createFrontPage($createFrontPageRequest->validated());

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
        $frontPage  =  $this->frontPageService->editFrontPage($request->frontPageId);

        return response()->json(
            new FrontPageResource($frontPage)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFrontPageRequest $updateFrontPageRequest)
    {

        try {
            DB::beginTransaction();
            $this->frontPageService->updateFrontPage($updateFrontPageRequest->validated());
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
            $this->frontPageService->deleteFrontPage($request->frontPageId);
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
        $this->frontPageService->changeStatus($request->frontPageId, $request->isPublished);
        return response()->json([
            'message' => __('messages.success.updated')
        ], 200);
    }


}
