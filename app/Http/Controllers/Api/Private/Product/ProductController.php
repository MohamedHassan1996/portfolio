<?php

namespace App\Http\Controllers\Api\Private\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\AllProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductImageService;
use App\Utils\PaginateCollection;
use App\Services\Product\ProductService;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;
    protected $uploadService;
    protected $productImageService;
    public function __construct(ProductService $productService, UploadService $uploadService, ProductImageService $productImageService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->productService = $productService;
        $this->uploadService = $uploadService;
        $this->productImageService = $productImageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productService->allProducts();

        return response()->json(
            new AllProductCollection(PaginateCollection::paginate($products, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateProductRequest $createProductRequest)
    {

        try {
            DB::beginTransaction();

            $data = $createProductRequest->validated();

            $product = $this->productService->createProduct($data);

            if (isset($data['images'])) {
                foreach ($data['images'] as $key => $image) {
                    $path = $this->uploadService->uploadFile($image['path'], "products/$product->id");

                    $this->productImageService->createProductImage([
                        'productId' => $product->id,
                        'path' => $path
                    ]);
                }
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
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $product  =  $this->productService->editProduct($request->productId);

        return response()->json(
            new ProductResource($product)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $updateProductRequest)
    {

        try {
            DB::beginTransaction();
            $data = $updateProductRequest->validated();

            $product = $this->productService->updateProduct($data);
            if (isset($data['images'])) {
                foreach ($data['images'] as $key => $image) {
                    $path = $this->uploadService->uploadFile($image['path'], "products/$product->id");

                    $this->productImageService->createProductImage([
                        'productId' => $product->id,
                        'path' => $path
                    ]);
                }
            }
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
            $this->productService->deleteProduct($request->productId);
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
        $this->productService->changeStatus($request->productId, $request->isPublished);
        return response()->json([
            'message' => __('messages.success.updated')
        ], 200);
    }

}
