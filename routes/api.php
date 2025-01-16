<?php

use App\Http\Controllers\Api\Private\Blog\BlogCategoryController;
use App\Http\Controllers\Api\Private\Blog\BlogController;
use App\Http\Controllers\Api\Private\Career\CandidateController;
use App\Http\Controllers\Api\Private\Career\CareerController;
use App\Http\Controllers\Api\Private\ContactUs\ContactUsController;
use App\Http\Controllers\Api\Private\ContactUs\ContactUsMessageController;
use App\Http\Controllers\Api\Private\ContactUs\WebsiteContactUsController;
use App\Http\Controllers\Api\Private\Customer\CustomerController;
use App\Http\Controllers\Api\Private\Event\EventController;
use App\Http\Controllers\Api\Private\Faq\FaqController;
use App\Http\Controllers\Api\Private\MainSetting\MainSettingController;
use App\Http\Controllers\Api\Private\FrontPage\FrontPagecontroller;
use App\Http\Controllers\Api\Private\FrontPage\FrontPageSectionController;
use App\Http\Controllers\Api\Private\Newsletter\NewsletterController;
use App\Http\Controllers\Api\Private\Newsletter\SubscriberController;
use App\Http\Controllers\Api\Private\Newsletter\WebsiteSubscriberController;
use App\Http\Controllers\Api\Private\Product\ProductCategoryController;
use App\Http\Controllers\Api\Private\Product\ProductController;
use App\Http\Controllers\Api\Private\Product\ProductImageController;
use App\Http\Controllers\Api\Private\Select\SelectController;
use App\Http\Controllers\Api\Private\User\UserController;
use App\Http\Controllers\Api\Public\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1/admin/auth')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('v1/{lang}/admin/users')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [UserController::class, 'index']);
    Route::post('create', [UserController::class, 'create']);
    Route::get('edit', [UserController::class, 'edit']);
    Route::put('update', [UserController::class, 'update']);
    Route::delete('delete', [UserController::class, 'delete']);
    Route::post('change-status', [UserController::class, 'changeStatus']);
});

Route::prefix('v1/{lang}/admin/customers')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [CustomerController::class, 'index']);
    Route::post('create', [CustomerController::class, 'create']);
    Route::get('edit', [CustomerController::class, 'edit']);
    Route::put('update', [CustomerController::class, 'update']);
    Route::delete('delete', [CustomerController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/blog-categories')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [BlogCategoryController::class, 'index']);
    Route::post('create', [BlogCategoryController::class, 'create']);
    Route::get('edit', [BlogCategoryController::class, 'edit']);
    Route::put('update', [BlogCategoryController::class, 'update']);
    Route::delete('delete', [BlogCategoryController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/blogs')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [BlogController::class, 'index']);
    Route::post('create', [BlogController::class, 'create']);
    Route::get('edit', [BlogController::class, 'edit']);
    Route::put('update', [BlogController::class, 'update']);
    Route::delete('delete', [BlogController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/events')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [EventController::class, 'index']);
    Route::post('create', [EventController::class, 'create']);
    Route::get('edit', [EventController::class, 'edit']);
    Route::put('update', [EventController::class, 'update']);
    Route::delete('delete', [EventController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/faqs')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [FaqController::class, 'index']);
    Route::post('create', [FaqController::class, 'create']);
    Route::get('edit', [FaqController::class, 'edit']);
    Route::put('update', [FaqController::class, 'update']);
    Route::delete('delete', [FaqController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/subscribers')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [SubscriberController::class, 'index']);
    Route::get('edit', [SubscriberController::class, 'edit']);
    Route::put('update', [SubscriberController::class, 'update']);
    Route::delete('delete', [SubscriberController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/newsletters')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [NewsletterController::class, 'index']);
    Route::post('create', [NewsletterController::class, 'create']);
    Route::get('edit', [NewsletterController::class, 'edit']);
    Route::put('update', [NewsletterController::class, 'update']);
    Route::delete('delete', [NewsletterController::class, 'delete']);
    Route::put('change-status', [NewsletterController::class, 'changeStatus']);
});

Route::prefix('v1/{lang}/admin/careers')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [CareerController::class, 'index']);
    Route::post('create', [CareerController::class, 'create']);
    Route::get('edit', [CareerController::class, 'edit']);
    Route::put('update', [CareerController::class, 'update']);
    Route::delete('delete', [CareerController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/candidates')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [CandidateController::class, 'index']);
    Route::post('create', [CandidateController::class, 'create']);
    Route::get('edit', [CandidateController::class, 'edit']);
    Route::delete('delete', [CandidateController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/product-categories')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [ProductCategoryController::class, 'index']);
    Route::post('create', [ProductCategoryController::class, 'create']);
    Route::get('edit', [ProductCategoryController::class, 'edit']);
    Route::put('update', [ProductCategoryController::class, 'update']);
    Route::delete('delete', [ProductCategoryController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/products')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [ProductController::class, 'index']);
    Route::post('create', [ProductController::class, 'create']);
    Route::get('edit', [ProductController::class, 'edit']);
    Route::put('update', [ProductController::class, 'update']);
    Route::delete('delete', [ProductController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/product-images')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [ProductImageController::class, 'index']);
    Route::post('create', [ProductImageController::class, 'create']);
    Route::delete('delete', [ProductImageController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/contact-us')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [ContactUsController::class, 'index']);
    Route::get('edit', [ContactUsController::class, 'edit']);
    Route::put('update', [ContactUsController::class, 'update']);
    Route::delete('delete', [ContactUsController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/contact-us-messages')->where(['lang' => 'en|ar'])->group(function(){
    Route::post('create', [ContactUsMessageController::class, 'create']);
    Route::put('read-message', [ContactUsMessageController::class, 'read']);
});

Route::prefix('v1/{lang}/admin/front-pages')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [FrontPagecontroller::class, 'index']);
    Route::post('create', [FrontPagecontroller::class, 'create']);
    Route::get('edit', [FrontPagecontroller::class, 'edit']);
    Route::put('update', [FrontPagecontroller::class, 'update']);
    Route::delete('delete', [FrontPagecontroller::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/front-page-sections')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [FrontPageSectionController::class, 'index']);
    Route::post('create', [FrontPageSectionController::class, 'create']);
    Route::get('edit', [FrontPageSectionController::class, 'edit']);
    Route::put('update', [FrontPageSectionController::class, 'update']);
    Route::delete('delete', [FrontPageSectionController::class, 'delete']);
});

Route::prefix('v1/{lang}/admin/main-settings')->where(['lang' => 'en|ar'])->group(function(){
    Route::post('create', [MainSettingController::class, 'create']);
    Route::get('edit', [MainSettingController::class, 'edit']);
    Route::put('update', [MainSettingController::class, 'update']);
});



Route::prefix('v1/subscribers')->group(function(){
    Route::post('create', [WebsiteSubscriberController::class, 'create']);
    Route::delete('delete', [WebsiteSubscriberController::class, 'delete']);
});

Route::prefix('v1/contact-us')->group(function(){
    Route::post('create', [WebsiteContactUsController::class, 'create']);
});


Route::prefix('v1/{lang}/admin/selects')->where(['lang' => 'en|ar'])->group(function(){
    Route::get('', [SelectController::class, 'getSelects']);
});

