<?php

namespace App\Http\Controllers\Api\Private\FrontPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPage\CreateFrontPageRequest;
use App\Http\Requests\FrontPage\UpdateFrontPageRequest;
use App\Http\Resources\FrontPage\AllFrontPageCollection;
use App\Http\Resources\FrontPage\FrontPageResource;
use App\Models\FrontPage\FrontPageSectionImage;
use App\Utils\PaginateCollection;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SectionImageController extends Controller
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
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $sectionImage = FrontPageSectionImage::find($request->imageId);
            Storage::disk('public')->delete($sectionImage->path);
            $sectionImage->delete();
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
