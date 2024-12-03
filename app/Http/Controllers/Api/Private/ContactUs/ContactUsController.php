<?php

namespace App\Http\Controllers\Api\Private\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUs\UpdateContactUsRequest;
use App\Http\Resources\ContactUs\AllContactUsCollection;
use App\Http\Resources\ContactUs\ContactUsResource;
use App\Utils\PaginateCollection;
use App\Services\ContactUs\ContactUsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactUsController extends Controller
{
    protected $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->contactUsService = $contactUsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contactUss = $this->contactUsService->allContactUss();

        return response()->json(
            new AllContactUsCollection(PaginateCollection::paginate($contactUss, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $contactUs  =  $this->contactUsService->editContactUs($request->contactUsId);

        return response()->json(
            new ContactUsResource($contactUs)//new UserResource($user)
        ,200);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $this->contactUsService->deleteContactUs($request->contactUsId);
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
        $this->contactUsService->changeStatus($request->contactUsId, $request->isPublished);
        return response()->json([
            'message' => 'تم تغيير حالة البلد بنجاح!'
        ], 200);
    }


}
