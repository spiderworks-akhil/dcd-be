<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\BlogController;
use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\CategoryController;
use App\Http\Controllers\Apis\CommonController;
use App\Http\Controllers\Apis\EventController;
use App\Http\Controllers\Apis\GalleryController;
use App\Http\Controllers\Apis\TestimonialController;
use App\Http\Controllers\Apis\JobController;
use App\Http\Controllers\Apis\ServiceController;
use App\Http\Controllers\Apis\TeamController;
use App\Http\Controllers\Apis\PartnerController;
use App\Http\Controllers\Apis\ProductController;
use App\Http\Controllers\Apis\NewsController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('app.login');
Route::post('verify-otp', [AuthController::class, 'verify_otp'])->middleware('throttle:5,1')->name('app.verify-otp');

Route::get('blogs', [BlogController::class, 'index'])->name('api.blogs.index');
Route::get('blogs/categories', [BlogController::class, 'categories'])->name('api.blogs.categories');
Route::get('blogs/{slug}', [BlogController::class, 'view'])->name('api.blogs.view');

Route::get('news', [NewsController::class, 'index'])->name('api.news.index');
Route::get('news/categories', [NewsController::class, 'categories'])->name('api.news.categories');
Route::get('news/featured', [NewsController::class, 'featured'])->name('api.news.featured');
Route::get('news/{slug}', [NewsController::class, 'view'])->name('api.news.view');

// events
Route::get('events', [EventController::class, 'index'])->name('api.events.index');
Route::get('events/featured', [EventController::class, 'featured'])->name('api.events.featured');
Route::get('events/categories', [EventController::class, 'categories'])->name('api.events.categories');
Route::get('events/{slug}', [EventController::class, 'view'])->name('api.events.view');

Route::get('events-list', [EventController::class, 'slug_list'])->name('api.events.slug_list');



Route::get('gallery', [GalleryController::class, 'index'])->name('api.gallery.index');
Route::get('gallery/categories', [GalleryController::class, 'categories'])->name('api.gallery.categories');

Route::get('gallery/{slug}', [GalleryController::class, 'view'])->name('api.gallery.view');
Route::get('gallery/medias/{slug}', [GalleryController::class, 'medias'])->name('api.gallery.medias');
Route::get('gallery/featured', [GalleryController::class, 'featured'])->name('api.gallery.featured');


Route::get('testimonials/featured', [TestimonialController::class, 'featured'])->name('api.testimonials.featured');
Route::get('testimonials', [TestimonialController::class, 'index'])->name('api.testimonials');

Route::get('service', [ServiceController::class, 'index'])->name('api.service.index');
Route::get('service/featured', [ServiceController::class, 'featured'])->name('api.service.featured');
Route::get('service/{slug}', [ServiceController::class, 'view'])->name('api.service.view');

Route::get('team', [TeamController::class, 'index'])->name('api.team.index');
Route::get('team/featured', [TeamController::class, 'featured'])->name('api.team.featured');
Route::get('team/{slug}', [TeamController::class, 'view'])->name('api.team.view');

Route::get('partner', [PartnerController::class, 'index'])->name('api.partner.index');
Route::get('partner/featured', [PartnerController::class, 'featured'])->name('api.partner.featured');
Route::get('partner/{slug}', [PartnerController::class, 'view'])->name('api.partner.view');

Route::get('jobs', [JobController::class, 'index'])->name('api.jobs.index');
Route::post('jobs/apply', [JobController::class, 'apply'])->middleware('throttle:10,1')->name('api.jobs.apply');

Route::get('menu/{position}', [CommonController::class, 'menu'])->name('api.menu');
Route::get('settings', [CommonController::class, 'settings'])->name('api.settings');
Route::get('page/{slug}', [CommonController::class, 'page'])->name('api.page');
Route::get('company-page/{slug}', [CommonController::class, 'company_page'])->name('api.company-page');
Route::get('company-page-list', [CommonController::class, 'company_page_list'])->name('api.company-page-list');
Route::get('faq', [CommonController::class, 'faq'])->name('api.faq');

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('leads', [CommonController::class, 'leads'])->name('api.leads');
    Route::get('leads/{id}', [CommonController::class, 'leads_view'])->name('api.leads_view');
});


Route::get('list-urls/{page}', [CommonController::class, 'list_urls'])->name('api.list-urls');

Route::post('contact/save', [CommonController::class, 'contact_save'])->middleware('throttle:10,1')->name('contacts.save');

Route::get('categories/{slug}', [CategoryController::class, 'detail'])->name('api.category.details');



// products
Route::get('product', [ProductController::class, 'index'])->name('api.product.index');
Route::get('product/{slug}', [ProductController::class, 'view'])->name('api.product.view');
Route::get('product/images/{id}', [ProductController::class, 'ProductImages'])->name('api.product.images');

Route::get('general-settings', [CommonController::class, 'GeneralSettings'])->name('api.general-settings');

//widgets

Route::get('widget/{code}',[CommonController::class,'widget'])->name('api.widget');
