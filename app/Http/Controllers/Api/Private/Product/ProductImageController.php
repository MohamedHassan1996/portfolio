<?php

namespace App\Http\Controllers\Api\Private\ProductImage;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductImage\AllProductImageCollection;
use App\Services\Product\ProductImageService;
use App\Utils\PaginateCollection;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
{
    protected $productImageService;
    protected $uploadService;
    protected $productImageImageService;
    public function __construct(UploadService $uploadService, ProductImageService $productImageService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->productImageService = $productImageService;
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productImages = $this->productImageService->allProductImages();

        return response()->json(
            new AllProductImageCollection(PaginateCollection::paginate($productImages, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = $request->images;

            foreach ($data['images'] as $key => $image) {
                $path = $this->uploadService->uploadFile($image['file'], "products/$request->productId");

                $this->productImageImageService->createProductImageImage([
                    'productId' => $request->productId,
                    'image' => $path
                ]);
            }
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
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $this->productImageService->deleteProductImage($request->productImageId);
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
