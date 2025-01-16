<?php

namespace App\Http\Controllers\FrontPages;

use App\Enums\Blog\BlogStatus;
use App\Enums\Product\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\FrontPage\FrontPage;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;


class ProductPageController extends Controller
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

        $productPage = FrontPage::where('controller_name', 'ProductPageController')->first();

        $productCategories = ProductCategory::all();

        $productsQuery = Product::with('images')
            ->where('is_active', ProductStatus::ACTIVE->value);

        // Filter by categoryId if provided
        if (request()->filled('categoryId')) {
            $productsQuery->where('product_category_id', request()->categoryId);
        }

        // Paginate results (9 per page)
        $products = $productsQuery->paginate(10);


        return view('Product.index', compact('productPage', 'productCategories', 'products'));
    }

    public function show($lang = 'en', $slug, $singleSlug, Request $request){
        $product = Product::with('translations')
        ->whereHas('translations', function ($query) use ($singleSlug) {
            $query->where('slug', $singleSlug)->where('locale', app()->getLocale());
        })
        ->first();

        if (!$product) {
            $product = Product::with('translations')
            ->whereHas('translations', function ($query) use ($singleSlug) {
                $query->where('slug', $singleSlug)->whereIn('locale', ['en', 'ar']);
            })
            ->first();
        }

        if (!$product) {
            abort(404);
        }

        $products = Product::where('is_active', ProductStatus::ACTIVE->value)->limit(3)->where('id', '!=', $product->id)->get();

       return view('Product.Sections.show', compact('product', 'products'));
    }
}
