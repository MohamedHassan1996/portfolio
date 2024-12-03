<?php

namespace App\Http\Controllers\Api\Private\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\Subscriber\CreateSubscriberRequest;
use App\Http\Requests\Newsletter\Subscriber\UpdateSubscriberRequest;
use App\Http\Resources\Newsletter\Subscriber\AllSubscriberCollection;
use App\Http\Resources\Newsletter\Subscriber\SubscriberResource;
use App\Utils\PaginateCollection;
use App\Services\Newsletter\SubscriberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubscriberController extends Controller
{
    protected $newsletterService;

    public function __construct(SubscriberService $newsletterService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->newsletterService = $newsletterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $newsletters = $this->newsletterService->allSubscribers();

        return response()->json(
            new AllSubscriberCollection(PaginateCollection::paginate($newsletters, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateSubscriberRequest $createSubscriberRequest)
    {

        try {
            DB::beginTransaction();

            $this->newsletterService->createSubscriber($createSubscriberRequest->validated());

            DB::commit();

            return response()->json([
                'message' => 'تم اضافة بلد جديد بنجاح'
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
        $newsletter  =  $this->newsletterService->editSubscriber($request->newsletterId);

        return response()->json(
            new SubscriberResource($newsletter)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriberRequest $updateSubscriberRequest)
    {

        try {
            DB::beginTransaction();
            $this->newsletterService->updateSubscriber($updateSubscriberRequest->validated());
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
            $this->newsletterService->deleteSubscriber($request->newsletterId);
            DB::commit();
            return response()->json([
                'message' => 'تم حذف البلد بنجاح!'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function changeStatus(Request $request)
    {
        $this->newsletterService->changeStatus($request->newsletterId, $request->isPublished);
        return response()->json([
            'message' => 'تم تغيير حالة البلد بنجاح!'
        ], 200);
    }


}
