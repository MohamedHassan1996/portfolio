<?php

namespace App\Http\Controllers\FrontPages;

use App\Enums\Blog\BlogStatus;
use App\Enums\Product\ProductStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\Career\Career;
use App\Models\FrontPage\FrontPage;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;


class CareerPageController extends Controller
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

        $careerPage = FrontPage::where('controller_name', 'CareerPageController')->first();

        $careers = Career::where('is_active', 1)->get();

        return view('Career.index', compact('careers'));
    }

    public function show($lang = 'en', $slug, $singleSlug, Request $request){
        $career = Career::with('translations')
        ->whereHas('translations', function ($query) use ($singleSlug) {
            $query->where('slug', $singleSlug)->where('locale', app()->getLocale());
        })
        ->first();

        if (!$career) {
            $career = Product::with('translations')
            ->whereHas('translations', function ($query) use ($singleSlug) {
                $query->where('slug', $singleSlug)->whereIn('locale', ['en', 'ar']);
            })
            ->first();
        }

        if (!$career) {
            abort(404);
        }


       return view('Career.Sections.show', compact('career'));
    }
}
