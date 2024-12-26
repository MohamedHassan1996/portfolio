<?php

namespace App\Http\Controllers\Api\Private\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductImage\ProductImageResource;
use App\Services\Product\ProductImageService;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
{    protected $uploadService;
    protected $productImageService;
    public function __construct(UploadService $uploadService, ProductImageService $productImageService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_product_images', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_porduct_image', ['only' => ['create']]);
        // $this->middleware('permission:delete_porduct_image', ['only' => ['delete']]);
        $this->productImageService = $productImageService;
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productImages = $this->productImageService->allProductImages($request->all());

        return ProductImageResource::collection($productImages);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {

        try {
            DB::beginTransaction();

            $data = $request->images;

            foreach ($data as $key => $image) {
                $path = $this->uploadService->uploadFile($image['path'], "products/$request->productId");

                $this->productImageService->createProductImage([
                    'productId' => $request->productId,
                    'path' => $path
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
