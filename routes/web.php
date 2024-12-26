<?php

use App\Http\Controllers\FrontPages\DynamicPageController;
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

Route::prefix('{lang}/')
    ->where(['lang' => 'en|ar'])
    ->middleware(['web'])
    ->group(function () {
        Route::get('{slug}', [DynamicPageController::class, 'index'])
            ->name('dynamic.page');
    });



