<?php

namespace App\Http\Controllers\FrontPages;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontPage\CreateFrontPageRequest;
use App\Http\Requests\FrontPage\UpdateFrontPageRequest;
use App\Http\Resources\FrontPage\AllFrontPageCollection;
use App\Http\Resources\FrontPage\FrontPageResource;
use App\Utils\PaginateCollection;
use App\Services\FrontPage\FrontPageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DynamicPageTwoController extends Controller
{
    protected $frontPageService;

    public function __construct(FrontPageService $frontPageService)
    {
        $this->frontPageService = $frontPageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($lang, $slug=null)
    {
        $slug = $slug == null && !in_array($lang, ['en', 'ar']) ? $lang : $slug;


        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'en';
        }



        // Fetch the controller name based on the slug
        $page = DB::table('front_page_translations')
            ->leftJoin('front_pages', 'front_page_translations.front_page_id', '=', 'front_pages.id')
            ->where('front_pages.is_active', 1)
            ->where('front_page_translations.slug', $slug??'')
            ->first();
        if($page && $page->locale != $lang){
            $page = DB::table('front_page_translations')
            ->leftJoin('front_pages', 'front_page_translations.front_page_id', '=', 'front_pages.id')
            ->where('front_pages.is_active', 1)
            ->where('front_page_translations.locale', $lang)
            ->where('front_page_translations.front_page_id', $page->front_page_id)
            ->first();

            $slug = $page->slug;
        }

        if (!$page) {
            abort(404, 'Page not found');
        }

        session(['active_navbar_link' => $slug??'']);
        if($lang == 'ar'){
            session(['body_direction' => [
                'direction' => 'rtl',
                'lang' => 'ar'
            ]]);
        }else{
            session(['body_direction' => [
                'direction' => 'ltr',
                'lang' => 'en'
            ]]);
        }

        // Map to a fixed controller based on the database record
        switch ($page->controller_name) {
            case 'HomePageController':
                return app(HomePageController::class)->index($lang, $slug);
            case 'ProductPageController':
                return app(ProductPageController::class)->index($lang, $slug);
            case 'AboutPageController':
                return app(AboutPageController::class)->index($lang, $slug);
            case 'ContactPageController':
                return app(ContactPageController::class)->index($lang, $slug);
            case 'FaqPageController':
                return app(FaqPageController::class)->index($lang, $slug);
            case 'BlogPageController':
                return app(BlogPageController::class)->index($lang, $slug);
            default:
                abort(404, 'Controller not defined');
        }


    }

}
