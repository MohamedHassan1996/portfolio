<?php

namespace App\Http\Controllers\Api\Private\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\CreateFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Http\Resources\Faq\AllFaqCollection;
use App\Http\Resources\Faq\FaqResource;
use App\Utils\PaginateCollection;
use App\Services\Faq\FaqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FaqController extends Controller
{
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->faqService = $faqService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $faqs = $this->faqService->allFaqs();

        return response()->json(
            new AllFaqCollection(PaginateCollection::paginate($faqs, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateFaqRequest $createFaqRequest)
    {

        try {
            DB::beginTransaction();

            $this->faqService->createFaq($createFaqRequest->validated());

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
        $faq  =  $this->faqService->editFaq($request->faqId);

        return response()->json(
            new FaqResource($faq)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $updateFaqRequest)
    {

        try {
            DB::beginTransaction();
            $this->faqService->updateFaq($updateFaqRequest->validated());
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
            $this->faqService->deleteFaq($request->faqId);
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
        $this->faqService->changeStatus($request->faqId, $request->isPublished);
        return response()->json([
            'message' => __('messages.success.updated')
        ], 200);
    }


}
