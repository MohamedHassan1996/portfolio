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
    public function index($lang='en', $slug=null)
    {
        $slug = $slug == null && !in_array($lang, ['en', 'ar']) ? $lang : $slug;

        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'en';
        }

        // Fetch the controller name based on the slug
        $page = DB::table('front_page_translations')
            ->leftJoin('front_pages', 'front_page_translations.front_page_id', '=', 'front_pages.id')
            ->where('front_pages.is_active', 1)
            ->where('front_page_translations.slug', $slug)
            ->first();

        /*if (!$page && url()->current() != url('/') && !in_array($lang, [ 'ar'])) {
            abort(404, 'Controller not found');
        } elseif ($page && $page->controller_name) {
            $controllerClass = "App\\Http\\Controllers\\FrontPages\\{$page->controller_name}";
        }elseif(!$page && count(explode('/', parse_url(url()->current(), PHP_URL_PATH))) > 2){

            abort(404, 'Controller not found');
        }else{
            $controllerClass = "App\\Http\\Controllers\\FrontPages\\HomePageController";
        }*/

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

            $controllerClass = "App\\Http\\Controllers\\FrontPages\\HomePageController";
        }else{
            $controllerClass = "App\\Http\\Controllers\\FrontPages\\{$page->controller_name}";
        }


        if (!class_exists($controllerClass)) {
            abort(404, 'Controller not found');
        }

        //dd($slug);

        session(['active_navbar_link' => $slug??'']);

        if($lang == 'ar'){
            session(['body_direction' => [
                'direction' => 'rtl',
                'lang' => 'ar',
                'body_class' => 'rtl'
            ]]);
        }else{
            session(['body_direction' => [
                'direction' => 'ltr',
                'lang' => 'en',
                'body_class' => ''
            ]]);
        }

        $controllerInstance = app()->make($controllerClass);
        return app()->call([$controllerInstance, 'index'], ['lang' => $lang, 'slug' => $slug]);
    }

    public function show($lang = '', $slug = '', $singleSlug = '')
    {

        if (!$singleSlug) {
            $singleSlug = $slug;
            $slug = $lang;
            $lang = app()->getLocale();
        }

        // Fetch the controller name based on the slug
        $page = DB::table('front_page_translations')
            ->leftJoin('front_pages', 'front_page_translations.front_page_id', '=', 'front_pages.id')
            ->where('front_pages.is_active', 1)
            ->where('front_page_translations.slug', $slug)
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
            $controllerClass = "App\\Http\\Controllers\\FrontPages\\HomePageController";
        } else {
            $controllerClass = "App\\Http\\Controllers\\FrontPages\\{$page->controller_name}";
        }

        if (!class_exists($controllerClass)) {
            abort(404, 'Controller not found');
        }

        session(['active_navbar_link' => $slug??'']);

        if($lang == 'ar'){
            session(['body_direction' => [
                'direction' => 'rtl',
                'lang' => 'ar',
                'body_class' => 'rtl'
            ]]);
        }else{
            session(['body_direction' => [
                'direction' => 'ltr',
                'lang' => 'en',
                'body_class' => ''
            ]]);
        }

        $controllerInstance = app()->make($controllerClass);
        return app()->call([$controllerInstance, 'show'], ['lang' => $lang, 'slug' => $slug, 'singleSlug' => $singleSlug]);
    }




}
