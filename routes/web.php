<?php

use App\Http\Controllers\FrontPages\DynamicPageController;
use App\Http\Controllers\FrontPages\HomePageController;
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
    // Match '/slug' → goes to index
    Route::get('{slug?}', [DynamicPageController::class, 'index'])
        ->where('slug', '^(?!ar|fr|es)[^/]*$') // Single segment, not 'ar', 'fr', 'es'
        ->name('dynamic.page');

    // Match '/slug/single-slug' → goes to show
    Route::get('{slug}/{single_slug}', [DynamicPageController::class, 'show'])
        ->where('slug', '^(?!ar|fr|es).*$') // Exclude 'ar', 'fr', 'es'
        ->name('dynamic.page.show');
});

// ✅ Language-prefixed routes for other languages
Route::prefix('{lang?}')
    ->where(['lang' => 'ar|fr|es']) // Supported languages except 'en'
    ->middleware(['web'])
    ->group(function () {
        // Match '/ar/slug'
        Route::get('{slug?}', [DynamicPageController::class, 'index'])
            ->where('slug', '[^/]*') // Single segment after language prefix
            ->name('dynamic.page');

        // Match '/ar/slug/single-slug'
        Route::get('{slug}/{single_slug}', [DynamicPageController::class, 'show'])
            ->name('dynamic.page.show');
    });
