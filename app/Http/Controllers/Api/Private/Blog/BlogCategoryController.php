<?php

namespace App\Http\Controllers\Api\Private\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\Category\CreateBlogCategoryRequest;
use App\Http\Requests\Blog\Category\UpdateBlogCategoryRequest;
use App\Http\Resources\Blog\BlogCategory\AllBlogCategoryCollection;
use App\Http\Resources\Blog\BlogCategory\BlogCategoryResource;
use App\Http\Resources\Category\AllCategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Utils\PaginateCollection;
use App\Services\Blog\BlogCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlogCategoryController extends Controller
{
    protected $blogCategoryService;

    public function __construct(BlogCategoryService $blogCategoryService)
    {
        $this->middleware('auth:api');
        $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        $this->middleware('permission:create_user', ['only' => ['create']]);
        $this->middleware('permission:edit_user', ['only' => ['edit']]);
        $this->middleware('permission:update_user', ['only' => ['update']]);
        $this->middleware('permission:delete_user', ['only' => ['delete']]);
        $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->blogCategoryService = $blogCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $blogCategories = $this->blogCategoryService->allBlogCategories();

        return response()->json(
            new AllBlogCategoryCollection(PaginateCollection::paginate($blogCategories, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateBlogCategoryRequest $createBlogCategoryRequest)
    {

        try {
            DB::beginTransaction();

            $this->blogCategoryService->createBlogCategory($createBlogCategoryRequest->validated());

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
        $category  =  $this->blogCategoryService->editBlogCategory($request->blogCategoryId);

        return response()->json(
            new BlogCategoryResource($category)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogCategoryRequest $updateBlogCategoryRequest)
    {

        try {
            DB::beginTransaction();
            $this->blogCategoryService->updateBlogCategory($updateBlogCategoryRequest->validated());
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
            $this->blogCategoryService->deleteBlogCategory($request->blogCategoryId);
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
