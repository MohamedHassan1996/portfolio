<?php

namespace App\Http\Controllers\FrontPages;

use App\Enums\Blog\BlogStatus;
use App\Enums\Product\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use App\Models\FrontPage\FrontPage;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;


class BlogPageController extends Controller
{
    protected $frontPageService;

    public function __construct(FrontPageService $frontPageService)
    {
        $this->frontPageService = $frontPageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($lang='en', $slug=null)
    {
        $locale = app()->getLocale();

        $blogPage = FrontPage::where('controller_name', 'BlogPageController')->first();

        $blogCategories = BlogCategory::withCount('blogs')->get();

        $blogQuery = Blog::where('is_published', BlogStatus::PUBLISHED->value);

        // Filter by categoryId if provided
        if (request()->filled('categoryId')) {
            $blogQuery->where('category_id', request()->categoryId);
        }

        // Paginate results (9 per page)
        $blogs = $blogQuery->paginate(1);

        return view('Blog.index', compact('blogPage', 'blogCategories', 'blogs'));
    }

    public function show($slug, $singleSlug, Request $request){
        $blog = Blog::with('translations')
        ->whereHas('translations', function ($query) use ($singleSlug) {
            $query->where('slug', $singleSlug)->where('locale', app()->getLocale());
        })
        ->first();

        $blogCategories = BlogCategory::withCount('blogs')->get();


        $latestBlogs = Blog::where('is_published', BlogStatus::PUBLISHED->value)
        ->where('id', '!=', $blog->id)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();

       return view('Blog.Sections.show', compact('blog', 'latestBlogs', 'blogCategories'));
    }
}
