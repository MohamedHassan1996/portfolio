<?php

namespace App\Http\Controllers\Api\Private\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Resources\Blog\AllBlogCollection;
use App\Http\Resources\Blog\BlogResource;
use App\Utils\PaginateCollection;
use App\Services\Blog\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:all_users', ['only' => ['allUsers']]);
        // $this->middleware('permission:create_user', ['only' => ['create']]);
        // $this->middleware('permission:edit_user', ['only' => ['edit']]);
        // $this->middleware('permission:update_user', ['only' => ['update']]);
        // $this->middleware('permission:delete_user', ['only' => ['delete']]);
        // $this->middleware('permission:change_user_status', ['only' => ['changeStatus']]);
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blogs = $this->blogService->allBlogs();

        return response()->json(
            new AllBlogCollection(PaginateCollection::paginate($blogs, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateBlogRequest $createBlogRequest)
    {

        try {
            DB::beginTransaction();

            $this->blogService->createBlog($createBlogRequest->validated());

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
        $blog  =  $this->blogService->editBlog($request->blogId);

        return response()->json(
            new BlogResource($blog)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $updateBlogRequest)
    {

        try {
            DB::beginTransaction();
            $this->blogService->updateBlog($updateBlogRequest->validated());
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
            $this->blogService->deleteBlog($request->blogId);
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
        $this->blogService->changeStatus($request->blogId, $request->isPublished);
        return response()->json([
            'message' => __('messages.success.updated')
        ], 200);
    }


}
