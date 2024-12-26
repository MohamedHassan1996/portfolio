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


class DynamicPageController extends Controller
{
    protected $frontPageService;

    public function __construct(FrontPageService $frontPageService)
    {
        $this->frontPageService = $frontPageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($lang, $slug)
    {
        // Fetch the controller name based on the slug
        $page = DB::table('front_page_translations')
            ->leftJoin('front_pages', 'front_page_translations.front_page_id', '=', 'front_pages.id')
            ->where('front_pages.is_active', 1)
            ->where('front_page_translations.slug', $slug)
            ->first();


        if (!$page) {
            abort(404, 'Page not found');
        }

        // Dynamically call the controller
        $controllerClass = "App\\Http\\Controllers\\FrontPages\\{$page->controller_name}";


        if (!class_exists($controllerClass)) {
            abort(404, 'Controller not found');
        }

        $controllerInstance = app()->make($controllerClass);
        return app()->call([$controllerInstance, 'index'], ['lang' => $lang, 'slug' => $slug]);
    }




}
