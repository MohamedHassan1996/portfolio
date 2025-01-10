<?php

use App\Http\Controllers\Api\Private\ContactUs\ContactUsController;
use App\Http\Controllers\Api\Private\Faq\FaqController;
use App\Http\Controllers\FrontPages\AboutPageController;
use App\Http\Controllers\FrontPages\ContactPageController;
use App\Http\Controllers\FrontPages\DynamicPageController;
use App\Http\Controllers\FrontPages\DynamicPageTwoController;
use App\Http\Controllers\FrontPages\FaqPageController;
use App\Http\Controllers\FrontPages\HomePageController;
use App\Http\Controllers\FrontPages\ProductPageController;
use App\Models\ContactUs\ContactUs;
use App\Models\Faq\Faq;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// ✅ Default (English) routes without prefix
Route::middleware(['web'])->group(function () {
    Route::get('{slug?}', [DynamicPageController::class, 'index'])
        ->where('slug', '^(?!ar|fr|es)[^/]*$') // Single segment, not 'ar', 'fr', 'es'
        ->name('dynamic.page');

    Route::get('{slug}/{single_slug}', [DynamicPageController::class, 'show'])
        ->where('slug', '^(?!ar|fr|es).*$') // Exclude 'ar', 'fr', 'es'
        ->name('dynamic.page.show');
});

// ✅ Language-prefixed routes for other languages
Route::prefix('{lang?}')
    ->where(['lang' => 'ar|fr|es']) // Supported languages except 'en'
    ->middleware(['web'])
    ->group(function () {
       Route::get('{slug?}', [DynamicPageController::class, 'index'])
            ->where('slug', '[^/]*') // Single segment after language prefix
            ->name('dynamic.page');

        // Match '/ar/slug/single-slug'
        Route::get('{slug}/{single_slug}', [DynamicPageController::class, 'show'])
            ->name('dynamic.page.show');
    });

/*Route::middleware(['web'])->group(function () {
    Route::get('{slug?}', function ($lang=null, $slug=null) {
        $lang = $lang ?? 'en';
        return app(DynamicPageTwoController::class)->index($lang, $slug);
    })
    ->where('slug', '^(?!ar|fr|es)[^/]*$')
    ->name('dynamic.page');
});


Route::prefix('{lang?}')
    ->where(['lang' => 'ar|fr|es|en']) // Supported languages
    ->middleware(['web'])
    ->group(function () {
        Route::get('/{slug?}', function ($lang=null, $slug=null) {
            $lang = $lang ?? 'en';
            return app(DynamicPageTwoController::class)->index($lang, $slug);
        })
        ->where('slug', '[^/]*') // Single segment after language prefix
        ->name('dynamic.page');
    });*/
