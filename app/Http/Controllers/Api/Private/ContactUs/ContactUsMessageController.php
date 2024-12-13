<?php

namespace App\Http\Controllers\Api\Private\ContactUs;

use App\Http\Controllers\Controller;
use App\Services\ContactUs\ContactMessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactUsMessageController extends Controller
{
    protected $contactUsMessageService;

    public function __construct(ContactMessageService $contactUsMessageService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->contactUsMessageService = $contactUsMessageService;
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $contactUsMessage = $this->contactUsMessageService->createContactUsMessage($request->contactUsId);
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