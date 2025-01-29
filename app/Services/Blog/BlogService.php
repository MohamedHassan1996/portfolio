<?php

namespace App\Services\Blog;

use App\Enums\Blog\BlogStatus;
use App\Filters\Blog\BlogSearchTranslatableFilter;
use App\Models\Blog\Blog;
use App\Services\Upload\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class BlogService{

    private $blog;
    private $uploadService;
    public function __construct(Blog $blog, UploadService $uploadService)
    {
        $this->blog = $blog;
        $this->uploadService = $uploadService;
    }

    public function allBlogs()
    {
        $locale = app()->getLocale(); // Get the current locale

        $blogs = QueryBuilder::for(Blog::class)
            ->withTranslation() // Fetch translations if applicable
            ->with(['blogCategory.translations' => function ($query) use ($locale) {
                $query->where('locale', $locale); // Load translations for the current locale
            }])
            ->allowedFilters([
                AllowedFilter::custom('search', new BlogSearchTranslatableFilter()), // Add a custom search filter
            ])
            ->get();

        return $blogs;

    }

    public function createBlog(array $blogData): Blog
    {

        $path = null;

        if(isset($blogData['thumbnail']) && $blogData['thumbnail'] instanceof UploadedFile){
            $path =  $this->uploadService->uploadFile($blogData['thumbnail'], 'blogs');
        }

        $blog = new Blog();

        $blog->is_published = BlogStatus::from($blogData['isPublished'])->value;
        $blog->thumbnail = $path;
        $blog->category_id = $blogData['categoryId'];


        if (!empty($blogData['titleAr'])) {
            $blog->translateOrNew('ar')->title = $blogData['titleAr'];
            $blog->translateOrNew('ar')->slug = $blogData['slugAr'];
            $blog->translateOrNew('ar')->content = $blogData['contentAr'];
            $blog->translateOrNew('ar')->meta_data = $blogData['metaDataAr'];
            $blog->translateOrNew('ar')->description = $blogData['descriptionAr'];
        }

        if (!empty($blogData['titleEn'])) {
            $blog->translateOrNew('en')->title = $blogData['titleEn'];
            $blog->translateOrNew('en')->slug = $blogData['slugEn'];
            $blog->translateOrNew('en')->content = $blogData['contentEn'];
            $blog->translateOrNew('en')->meta_data = $blogData['metaDataEn'];
            $blog->translateOrNew('en')->description = $blogData['descriptionEn'];
        }

        $blog->save();

        return $blog;

    }

    public function editBlog(int $blogId)
    {
        return Blog::with('translations')->find($blogId);
    }

    public function updateBlog(array $blogData): Blog
    {

        $blog = Blog::find($blogData['blogId']);

        $blog->is_published = BlogStatus::from($blogData['isPublished'])->value;
        $blog->category_id = $blogData['categoryId'];

        $path = null;

        if(isset($blogData['thumbnail']) && $blogData['thumbnail'] instanceof UploadedFile){
            $path =  $this->uploadService->uploadFile($blogData['thumbnail'], 'blogs');
        }

        if($blog->thumbnail && $path){
            Storage::disk('public')->delete($blog->thumbnail);
        }

        if($path){
            $blog->thumbnail = $path;
        }

        if (!empty($blogData['titleAr'])) {
            $blog->translateOrNew('ar')->title = $blogData['titleAr'];
            $blog->translateOrNew('ar')->slug = $blogData['slugAr'];
            $blog->translateOrNew('ar')->content = $blogData['contentAr'];
            $blog->translateOrNew('ar')->meta_data = $blogData['metaDataAr'];
            $blog->translateOrNew('ar')->description = $blogData['descriptionAr'];
        }

        if (!empty($blogData['titleEn'])) {
            $blog->translateOrNew('en')->title = $blogData['titleEn'];
            $blog->translateOrNew('en')->slug = $blogData['slugEn'];
            $blog->translateOrNew('en')->content = $blogData['contentEn'];
            $blog->translateOrNew('en')->meta_data = $blogData['metaDataEn'];
            $blog->translateOrNew('en')->description = $blogData['descriptionEn'];
        }

        $blog->save();

        return $blog;


    }


    public function deleteBlog(int $blogId)
    {

        $blog  = Blog::find($blogId);

        if($blog->thumbnail){
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

    }


    public function changeStatus(int $blogId, bool $isPublished)
    {
        $blog = Blog::find($blogId);
        $blog->is_published = $isPublished;
        $blog->save();
    }

}
