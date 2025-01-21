<?php

namespace App\Http\Controllers\Api\Private\MainSetting;

use App\Http\Controllers\Controller;
use App\Services\MainSetting\MainSettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MainSettingController extends Controller
{
    protected $mainSettingService;

    public function __construct(MainSettingService $mainSettingService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->mainSettingService = $mainSettingService;
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {

        try {
            DB::beginTransaction();

            $mainSettingsData = $request->all();

            $mainSettings = $this->mainSettingService->createMainSetting($mainSettingsData);

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
        $mainSettings  =  $this->mainSettingService->editMainSetting($request->mainSettingId);

        return response()->json([
            'data' => [
                'mainSettingId' => $mainSettings->id,
                'content' => $mainSettings->content,
                'logo' => $mainSettings->logo?Storage::disk('public')->url($mainSettings->logo):"",
                'favicon' => $mainSettings->favicon?Storage::disk('public')->url($mainSettings->favicon):"",
            ]
        ],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try {
            DB::beginTransaction();
            $mainSettingsData = $request->all();
            $mainSettings = $this->mainSettingService->updateMainSetting($mainSettingsData);
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


}
