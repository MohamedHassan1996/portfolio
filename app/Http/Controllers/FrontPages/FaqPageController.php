<?php

namespace App\Http\Controllers\FrontPages;

use App\Enums\Blog\BlogStatus;
use App\Enums\Faq\FaqStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\Faq\Faq;
use App\Models\FrontPage\FrontPage;
use App\Models\Product\Product;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;


class FaqPageController extends Controller
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




        $faqPage = FrontPage::where('controller_name', 'FaqPageController')->first();

        $faqs = Faq::where('is_published', FaqStatus::PUBLISHED->value)->get();
        return view('Faq.index', compact('faqPage', 'faqs'));
    }
}
