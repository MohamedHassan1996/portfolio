<?php

namespace App\Services\Blog;

use App\Enums\Blog\BlogCategoryStatus;
use App\Filters\Blog\BlogCategoryTranslatableFilter;
use App\Models\Blog\BlogCategory;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BlogCategoryService{

    private $blogBlogCategory;
    public function __construct(BlogCategory $blogBlogCategory)
    {
        $this->blogBlogCategory = $blogBlogCategory;
    }

    public function allBlogCategories()
    {
        $blogCategories = QueryBuilder::for(BlogCategory::class)
        ->withTranslation() // Fetch translations if applicable
        ->allowedFilters([
            AllowedFilter::custom('search', new BlogCategoryTranslatableFilter()), // Add a custom search filter
        ])
        ->get();

        return $blogCategories;

    }

    public function createBlogCategory(array $blogCategoryData): BlogCategory
    {


        $blogCategory = new BlogCategory();

        $blogCategory->is_active = BlogCategoryStatus::from($blogCategoryData['isActive'])->value;

        if (!empty($blogCategoryData['nameAr'])) {
            $blogCategory->translateOrNew('ar')->name = $blogCategoryData['nameAr'];
            $blogCategory->translateOrNew('ar')->slug = $blogCategoryData['slugAr'];
        }

        if (!empty($blogCategoryData['nameEn'])) {
            $blogCategory->translateOrNew('en')->name = $blogCategoryData['nameEn'];
            $blogCategory->translateOrNew('en')->slug = $blogCategoryData['slugEn'];
        }

        $blogCategory->save();

        return $blogCategory;

    }

    public function editBlogCategory(int $blogCategoryId)
    {
        return BlogCategory::with('translations')->find($blogCategoryId);
    }

    public function updateBlogCategory(array $blogCategoryData): BlogCategory
    {

        $blogCategory = BlogCategory::find($blogCategoryData['blogCategoryId']);

        $blogCategory->is_active = BlogCategoryStatus::from($blogCategoryData['isActive'])->value;

        if (!empty($blogCategoryData['nameAr'])) {
            $blogCategory->translateOrNew('ar')->name = $blogCategoryData['nameAr'];
            $blogCategory->translateOrNew('ar')->slug = $blogCategoryData['slugAr'];
        }

        if (!empty($blogCategoryData['nameEn'])) {
            $blogCategory->translateOrNew('en')->name = $blogCategoryData['nameEn'];
            $blogCategory->translateOrNew('en')->slug = $blogCategoryData['slugEn'];
        }

        $blogCategory->save();


        return $blogCategory;


    }


    public function deleteBlogCategory(int $blogCategoryId)
    {

        return BlogCategory::find($blogCategoryId)->delete();

    }

}
