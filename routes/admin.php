<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventLogController;
use App\Http\Controllers\Admin\RedirectController;
use App\Http\Controllers\Admin\WebadminController;
use App\Http\Controllers\Admin\AdminLinkController;
use App\Http\Controllers\Admin\QuickTaskController;
use App\Http\Controllers\Admin\ListigItemController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\LoginHistoryController;
use App\Http\Controllers\Admin\PhotoGallaryController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\Auth\AuthenticateSessionOtpController;
use App\Http\Controllers\Admin\NewsController;

$prefix = (config()->has('admin.url_prefix'))?config()->get('admin.url_prefix'):'admin';
$middleware = (config()->has('admin.admin_middleware'))?config()->get('admin.admin_middleware'):'auth';

Route::post('google/auth', [WebadminController::class, 'google_login'])->name('google.login');

Route::group(['prefix' => $prefix, 'middleware' => ['web']], function () use($middleware) {


    Route::post('/request-otp', [AuthenticateSessionOtpController::class, 'request_otp'])->name('admin.auth.request-otp');
    Route::post('/validate-otp', [AuthenticateSessionOtpController::class, 'validate_otp'])->name('admin.auth.validate-otp');
    Route::get('/resend-otp/{id}', [AuthenticateSessionOtpController::class, 'resend_otp'])->name('admin.auth.resend-otp');
    Route::post('/logout', [AuthenticateSessionOtpController::class, 'logout'])->name('admin.auth.logout');

    Route::get('validation/unique-slug', [WebadminController::class, 'unique_slug'])->name('admin.unique-slug');

    Route::get('select2/tags', [WebadminController::class, 'select2_tags'])->name('admin.select2.tags');
    Route::get('select2/listings', [WebadminController::class, 'select2_listings'])->name('admin.select2.listings');
    Route::get('select2/authors', [WebadminController::class, 'select2_authors'])->name('admin.select2.authors');

    Route::get('clone/slug', [WebadminController::class, 'CloneSlug'])->name('admin.clone-slug');


	Route::group(['middleware' => $middleware], function(){

		Route::get('/dashboard', [WebadminController::class, 'index'])->name('admin.dashboard');

        Route::get('change-password', array('as' => 'admin.change-password', function(){
            return View::make('admin.change_password');
        }));

        Route::post('images', [BlogController::class, 'storeImage'])->name('images.store');

        Route::post('/changePassword', [WebadminController::class, 'changePassword'])->name('admin.update-password');

        Route::get('/validation/roles', [WebadminController::class, 'unique_roles'])->name('admin.validation.roles');
        Route::get('/validation/users', [WebadminController::class, 'unique_users'])->name('admin.validation.users');

        //widgets

        Route::get('/media-centre', [WebadminController::class, 'MediaCentre'])->name('admin.media_centre.index');


        Route::get('/widgets', [WebadminController::class, 'widgets'])->name('admin.widgets.index');
        Route::post('/widgets/save', [WebadminController::class, 'save_widget'])->name('admin.widgets.save');

        //users
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::get('/users/show/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::get('/users/destroy/{id}', [UserController::class, 'destroy'] )->name('admin.users.destroy');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users/update', [UserController::class, 'update'])->name('admin.users.update');
        Route::get('/users/change-status/{id}', [UserController::class, 'changeStatus'])->name('admin.users.change-status');
        Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');

        //permissions
        Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
        Route::get('/permissions/show/{id}', [PermissionController::class, 'show'])->name('admin.permissions.show');
        Route::get('/permissions/destroy/{id}', [PermissionController::class, 'destroy'] )->name('admin.permissions.destroy');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
        Route::post('/permissions/update', [PermissionController::class, 'update'])->name('admin.permissions.update');
        Route::post('/permissions/store', [PermissionController::class, 'store'])->name('admin.permissions.store');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
        Route::get('/permissions/change-status/{id}', function(){
            echo "Permission Denied"; exit;
        })->name('admin.permissions.change-status');

        //roles
        Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::get('/roles/show/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
        Route::get('/roles/destroy/{id}', [RoleController::class, 'destroy'] )->name('admin.roles.destroy');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/roles/update', [RoleController::class, 'update'])->name('admin.roles.update');
        Route::get('/roles/change-status/{id}', [RoleController::class, 'changeStatus'])->name('admin.roles.change-status');
        Route::post('/roles/store', [RoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');

        //admin links
        Route::get('/admin-links/edit/{id}', [AdminLinkController::class, 'edit'])->name('admin.admin-links.edit');
        Route::get('/admin-links/destroy/{id}', [AdminLinkController::class, 'destroy'] )->name('admin.admin-links.destroy');
        Route::get('/admin-links/create', [AdminLinkController::class, 'create'])->name('admin.admin-links.create');
        Route::post('/admin-links/update', [AdminLinkController::class, 'update'])->name('admin.admin-links.update');
        Route::post('/admin-links/store', [AdminLinkController::class, 'store'])->name('admin.admin-links.store');
        Route::get('/admin-links/{id?}', [AdminLinkController::class, 'index'])->name('admin.admin-links.index');
        Route::get('/admin-links/change-status/{id}', function(){
            echo "Permission Denied"; exit;
        })->name('admin.admin-links.change-status');
        Route::post('/admin-links/order-store', [AdminLinkController::class, 'order_store'])->name('admin.admin-links.order-store');

        //media
        Route::get('/media', [MediaController::class, 'index'])->name('admin.media.index');
        Route::post('/media/destroy', [MediaController::class, 'destroy'] )->name('admin.media.destroy');
        Route::post('/media', [MediaController::class, 'index'])->name('admin.media.index.post');
        Route::get('/media/popup/{popup_type?}/{type?}/{holder_attr?}/{title?}/{related_id?}/{media_id?}/{display?}', [MediaController::class, 'popup'])->name('admin.media.popup');
        Route::post('/media/save', [MediaController::class, 'save'])->name('admin.media.save');
        Route::get('/media/edit/{id}/{type?}', [MediaController::class, 'edit'])->name('admin.media.edit');
        Route::get('/media/show/{id}', [MediaController::class, 'show'])->name('admin.media.show');
        Route::post('/media/store-extra/{id}', [MediaController::class, 'storeExtra'])->name('admin.media.store-extra');
        Route::post('/media/update', [MediaController::class, 'update'])->name('admin.media.update');
        Route::post('/media/set-media', [MediaController::class, 'set_media'])->name('admin.media.set-media');
        Route::post('/media/editor-upload', [MediaController::class, 'editor_upload'])->name('admin.media.editor-upload');


        //blogs
        Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
        Route::get('blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
        Route::get('blogs/edit/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
        Route::get('blogs/destroy/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
        Route::get('blogs/change-status/{id}', [BlogController::class, 'changeStatus'])->name('admin.blogs.change-status');
        Route::post('blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');
        Route::post('blogs/update', [BlogController::class, 'update'])->name('admin.blogs.update');
        Route::get('blogs/show/{id}', [BlogController::class, 'show'])->name('admin.blogs.show');

        //News
        Route::get('news', [NewsController::class, 'index'])->name('admin.news.index');
        Route::get('news/create', [NewsController::class, 'create'])->name('admin.news.create');
        Route::get('news/edit/{id}', [NewsController::class, 'edit'])->name('admin.news.edit');
        Route::get('news/destroy/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
        Route::get('news/change-status/{id}', [NewsController::class, 'changeStatus'])->name('admin.news.change-status');
        Route::post('news/store', [NewsController::class, 'store'])->name('admin.news.store');
        Route::post('news/update', [NewsController::class, 'update'])->name('admin.news.update');
        Route::get('news/show/{id}', [NewsController::class, 'show'])->name('admin.news.show');
        Route::get('news/get-type', [NewsController::class, 'GetType'])->name('admin.news.get-type');


        //menus
        Route::get('menus', [MenuController::class, 'index'])->name('admin.menus.index');
        Route::get('menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
        Route::get('menus/edit/{id}', [MenuController::class, 'edit'])->name('admin.menus.edit');
        Route::get('menus/destroy/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
        Route::get('menus/change-status/{id}', [MenuController::class, 'changeStatus'])->name('admin.menus.change-status');
        Route::post('menus/store', [MenuController::class, 'store'])->name('admin.menus.store');
        Route::post('menus/update', [MenuController::class, 'update'])->name('admin.menus.update');

        //sliders
        Route::get('sliders/edit/{id}/{type?}', [SliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::get('sliders/destroy/{id}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
        Route::get('sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
        Route::post('sliders/update', [SliderController::class, 'update'])->name('admin.sliders.update');
        Route::post('sliders/update-photo', [SliderController::class, 'updatePhoto'])->name('admin.sliders.update-photo');
        Route::post('sliders/store', [SliderController::class, 'store'])->name('admin.sliders.store');
        Route::get('sliders/photo-edit/{id}/{slider_id}/{type}', [SliderController::class, 'photo_edit'])->name('admin.sliders.photo_edit');
        Route::get('sliders/photo-delete/{slider_id}/{id}/{type}', [SliderController::class, 'photo_delete'])->name('admin.sliders.photo-delete');
        Route::get('sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('sliders/validation/unique-name', [SliderController::class, 'validate_name'])->name('admin.sliders.unique-name');
        Route::get('sliders/change-status/{id}', function(){
            echo "Not possible";exit;
        })->name('admin.sliders.change-status');
        Route::post('sliders/update-order', [SliderController::class, 'update_order'])->name('admin.sliders.update-order');

        //faq
        Route::get('faq/edit/{id}/{type}', [FaqController::class, 'edit'])->name('admin.faq.edit');
        Route::get('faq/destroy/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');
        Route::post('faq/store', [FaqController::class, 'store'])->name('admin.faq.store');
        Route::post('faq/update', [FaqController::class, 'update'])->name('admin.faq.update');
        Route::post('faq/re-order', [FaqController::class, 'order_store'])->name('admin.faq.re-order');
        Route::get('faq/create/{related_id}/{related_type}', [FaqController::class, 'create'])->name('admin.faq.create');
        Route::get('faq/{related_id}/{related_type}', [FaqController::class, 'index'])->name('admin.faq.index');

        //testimonials
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
        Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('admin.testimonials.create');
        Route::get('testimonials/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
        Route::get('testimonials/destroy/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
        Route::post('testimonials/store', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
        Route::post('testimonials/update', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
        Route::get('testimonials/change-status/{id}', [TestimonialController::class, 'changeStatus'])->name('admin.testimonials.change-status');
        Route::get('testimonials/show/{id}', [TestimonialController::class, 'show'])->name('admin.testimonials.show');

        //category
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::get('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::get('/categories/create/{parent?}', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories/update', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/change-status/{id}', [CategoryController::class, 'changeStatus'])->name('admin.categories.change-status');
        Route::get('categories/get-type', [CategoryController::class, 'GetType'])->name('admin.categories.get-type');
        Route::get('/categories/{parent?}', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');




        //settings
        Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings/store', [SettingController::class, 'store'])->name('admin.settings.store');

        //user_activities
        Route::get('logs', [LogController::class, 'index'])->name('admin.logs.index');
        Route::get('logs/create', function(){
            echo "No access permission";exit;
        })->name('admin.logs.create');
        Route::get('logs/edit/{id}', function(){
            echo "No access permission";exit;
        })->name('admin.logs.edit');
        Route::get('logs/destroy/{id}', [LogController::class, 'destroy'])->name('admin.logs.destroy');
        Route::post('logs/store', function(){
            echo "No access permission";exit;
        })->name('admin.logs.store');
        Route::post('logs/update', function(){
            echo "No access permission";exit;
        })->name('admin.logs.update');
        Route::get('logs/change-status/{id}', function(){
            echo "No access permission";exit;
        })->name('admin.logs.change-status');
        Route::get('logs/show/{id}', [LogController::class, 'show'])->name('admin.logs.show');

        //static pages
        Route::get('static-pages', [StaticPageController::class, 'index'])->name('admin.static-pages.index');
        Route::get('static-pages/create', [StaticPageController::class, 'create'])->name('admin.static-pages.create');
        Route::post('static-pages/store', [StaticPageController::class, 'store'])->name('admin.static-pages.store');
        Route::get('static-pages/edit/{id}', [StaticPageController::class, 'edit'])->name('admin.static-pages.edit');
        Route::post('static-pages/update', [StaticPageController::class, 'update'])->name('admin.static-pages.update');
        Route::get('static-pages/show/{id}', [StaticPageController::class, 'show'])->name('admin.static-pages.show');
        Route::get('header', [StaticPageController::class, 'HeaderView'])->name('admin.header.view');
        Route::get('get-slug', [StaticPageController::class, 'GetSlug'])->name('admin.get-slug');

        //pages
        Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::get('/pages/destroy/{id}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
        Route::get('/pages/create/{parent?}', [PageController::class, 'create'])->name('admin.pages.create');
        Route::post('/pages/update', [PageController::class, 'update'])->name('admin.pages.update');
        Route::post('/pages/store', [PageController::class, 'store'])->name('admin.pages.store');
        Route::get('/pages/change-status/{id}', [PageController::class, 'changeStatus'])->name('admin.pages.change-status');
        Route::get('/pages/{parent?}', [PageController::class, 'index'])->name('admin.pages.index');
        Route::get('/pages/show/{id}', [PageController::class, 'show'])->name('admin.pages.show');

        //photo gallery
        Route::get('photo-galleries/edit/{id}/{type?}', [PhotoGallaryController::class, 'edit'])->name('admin.photo-galleries.edit');
        Route::get('photo-galleries/destroy/{id}', [PhotoGallaryController::class, 'destroy'])->name('admin.photo-galleries.destroy');
        Route::get('photo-galleries/create', [PhotoGallaryController::class, 'create'])->name('admin.photo-galleries.create');
        Route::post('photo-galleries/update', [PhotoGallaryController::class, 'update'])->name('admin.photo-galleries.update');
        Route::post('photo-galleries/update-photo', [PhotoGallaryController::class, 'updatePhoto'])->name('admin.photo-galleries.update-photo');
        Route::post('photo-galleries/store', [PhotoGallaryController::class, 'store'])->name('admin.photo-galleries.store');
        Route::get('photo-galleries/photo-edit/{id}/{gallery_id}/{type}', [PhotoGallaryController::class, 'photo_edit'])->name('admin.photo-galleries.photo_edit');
        Route::get('photo-galleries/photo-delete/{gallery_id}/{id}/{type}', [PhotoGallaryController::class, 'photo_delete'])->name('admin.photo-galleries.photo-delete');
        Route::get('photo-galleries', [PhotoGallaryController::class, 'index'])->name('admin.photo-galleries.index');
        Route::get('photo-galleries/validation/unique-name', [PhotoGallaryController::class, 'validate_name'])->name('admin.photo-galleries.unique-name');
        Route::get('photo-galleries/change-status/{id}', function(){
            echo "Not possible";exit;
        })->name('admin.photo-galleries.change-status');

        //team
        Route::get('team', [TeamController::class, 'index'])->name('admin.team.index');
        Route::get('team/create', [TeamController::class, 'create'])->name('admin.team.create');
        Route::get('team/edit/{id}/{tab?}', [TeamController::class, 'edit'])->name('admin.team.edit');
        Route::get('team/destroy/{id}', [TeamController::class, 'destroy'])->name('admin.team.destroy');
        Route::get('team/change-status/{id}', [TeamController::class, 'changeStatus'])->name('admin.team.change-status');
        Route::post('team/store', [TeamController::class, 'store'])->name('admin.team.store');
        Route::post('team/update', [TeamController::class, 'update'])->name('admin.team.update');
        Route::get('team/show/{id}', [TeamController::class, 'show'])->name('admin.team.show');
        Route::get('team/get-type', [TeamController::class, 'GetType'])->name('admin.team.get-type');


        //services
        Route::get('/services/edit/{id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
        Route::get('/services/destroy/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
        Route::get('/services/create/{parent?}', [ServiceController::class, 'create'])->name('admin.services.create');
        Route::post('/services/update', [ServiceController::class, 'update'])->name('admin.services.update');
        Route::post('/services/store', [ServiceController::class, 'store'])->name('admin.services.store');
        Route::get('/services/change-status/{id}', [ServiceController::class, 'changeStatus'])->name('admin.services.change-status');
        Route::get('/services/{parent?}', [ServiceController::class, 'index'])->name('admin.services.index');
        Route::get('/services/show/{id}', [ServiceController::class, 'show'])->name('admin.services.show');
        Route::get('services/get-type', [ServiceController::class, 'GetType'])->name('admin.services.get-type');

        //jobs
        Route::get('jobs', [JobController::class, 'index'])->name('admin.jobs.index');
        Route::get('jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
        Route::get('jobs/edit/{id}/{tab?}', [JobController::class, 'edit'])->name('admin.jobs.edit');
        Route::get('jobs/destroy/{id}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
        Route::get('jobs/change-status/{id}', [JobController::class, 'changeStatus'])->name('admin.jobs.change-status');
        Route::post('jobs/store', [JobController::class, 'store'])->name('admin.jobs.store');
        Route::post('jobs/update', [JobController::class, 'update'])->name('admin.jobs.update');
        Route::get('jobs/validation/unique-code', [JobController::class, 'validate_job_code'])->name('admin.jobs.unique-code');

        //leads
        Route::get('leads', [LeadController::class, 'index'])->name('admin.leads.index');
        Route::get('leads/create', function(){
            echo "Not possible";exit;
        })->name('admin.leads.create');
        Route::get('leads/edit/{id}', [LeadController::class, 'edit'])->name('admin.leads.edit');
        Route::get('leads/destroy/{id}', [LeadController::class, 'destroy'])->name('admin.leads.destroy');
        Route::post('leads/store', function(){
            echo "Not possible";exit;
        })->name('admin.leads.store');
        Route::post('leads/update', [LeadController::class, 'update'])->name('admin.leads.update');
        Route::get('leads/change-status/{id}', [LeadController::class, 'changeStatus'])->name('admin.leads.change-status');
        Route::get('leads/show/{id}', [LeadController::class, 'show'])->name('admin.leads.show');
        Route::get('leads/export',[LeadController::class,'export'])->name('admin.leads.export');

        //redirects
        Route::get('redirects', [RedirectController::class, 'index'])->name('admin.redirects.index');
        Route::get('redirects/create', [RedirectController::class, 'create'])->name('admin.redirects.create');
        Route::get('redirects/edit/{id}/{tab?}', function(){
            echo "Not possible";exit;
        })->name('admin.redirects.edit');
        Route::get('redirects/destroy/{id}', [RedirectController::class, 'destroy'])->name('admin.redirects.destroy');
        Route::get('redirects/change-status/{id}', function(){
            echo "No access";exit;
        })->name('admin.redirects.change-status');
        Route::post('redirects/store', [RedirectController::class, 'store'])->name('admin.redirects.store');
        Route::post('redirects/update', function(){
            echo "Not possible";exit;
        })->name('admin.redirects.update');
        Route::get('redirects/show/{id}', function(){
            echo "Not possible";exit;
        })->name('admin.redirects.show');

        //quick tasks
        Route::get('quick-tasks', [QuickTaskController::class, 'index'])->name('admin.quick-tasks.index');
        Route::get('quick-tasks/create', [QuickTaskController::class, 'create'])->name('admin.quick-tasks.create');
        Route::get('quick-tasks/edit/{id}', [QuickTaskController::class, 'edit'])->name('admin.quick-tasks.edit');
        Route::get('quick-tasks/destroy/{id}', [QuickTaskController::class, 'destroy'])->name('admin.quick-tasks.destroy');
        Route::get('quick-tasks/change-status/{id}', [QuickTaskController::class, 'changeStatus'])->name('admin.quick-tasks.change-status');
        Route::post('quick-tasks/store', [QuickTaskController::class, 'store'])->name('admin.quick-tasks.store');
        Route::post('quick-tasks/update', [QuickTaskController::class, 'update'])->name('admin.quick-tasks.update');
        Route::get('quick-tasks/show/{id}', [QuickTaskController::class, 'show'])->name('admin.quick-tasks.show');

        //projects
        Route::get('projects', [ProjectController::class, 'index'])->name('admin.projects.index');
        Route::get('projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
        Route::get('projects/edit/{id}', [ProjectController::class, 'edit'])->name('admin.projects.edit');
        Route::get('projects/destroy/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
        Route::get('projects/change-status/{id}', [ProjectController::class, 'changeStatus'])->name('admin.projects.change-status');
        Route::post('projects/store', [ProjectController::class, 'store'])->name('admin.projects.store');
        Route::post('projects/update', [ProjectController::class, 'update'])->name('admin.projects.update');
        Route::get('projects/show/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');

        //login history
        Route::get('login-history', [LoginHistoryController::class, 'index'])->name('admin.login-history.index');
        Route::get('login-history/create', function(){
            echo "Not possible";exit;
        })->name('admin.login-history.create');
        Route::get('login-history/edit/{id}', function(){
            echo "Not possible";exit;
        })->name('admin.login-history.edit');
        Route::get('login-history/destroy/{id}', [LoginHistoryController::class, 'destroy'])->name('admin.login-history.destroy');
        Route::post('login-history/store', function(){
            echo "Not possible";exit;
        })->name('admin.login-history.store');
        Route::post('login-history/update', function(){
            echo "Not possible";exit;
        })->name('admin.login-history.update');
        Route::get('login-history/change-status/{id}', function(){
            echo "Not possible";exit;
        })->name('admin.login-history.change-status');
        Route::get('login-history/show/{id}', function(){
            echo "Not possible";exit;
        })->name('admin.login-history.show');

        //comments
        Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
        Route::get('comments/create/{parent}', [CommentController::class, 'create'])->name('admin.comments.create');
        Route::get('comments/edit/{id}', [CommentController::class, 'edit'])->name('admin.comments.edit');
        Route::get('comments/destroy/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
        Route::get('comments/change-status/{id}', [CommentController::class, 'changeStatus'])->name('admin.comments.change-status');
        Route::post('comments/store', [CommentController::class, 'store'])->name('admin.comments.store');
        Route::post('comments/update', [CommentController::class, 'update'])->name('admin.comments.update');
        Route::get('comments/show/{id}', [CommentController::class, 'show'])->name('admin.comments.show');

         //events
         Route::get('events', [EventController::class, 'index'])->name('admin.events.index');
         Route::get('events/create', [EventController::class, 'create'])->name('admin.events.create');
         Route::get('events/edit/{id}', [EventController::class, 'edit'])->name('admin.events.edit');
         Route::get('events/destroy/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');
         Route::get('events/change-status/{id}', [EventController::class, 'changeStatus'])->name('admin.events.change-status');
         Route::post('events/store', [EventController::class, 'store'])->name('admin.events.store');
         Route::post('events/update', [EventController::class, 'update'])->name('admin.events.update');
         Route::get('events/show/{id}', [EventController::class, 'show'])->name('admin.events.show');
         Route::get('events/media/edit/{id}/{type}', [EventController::class, 'media_edit'])->name('admin.events.media.edit');
         Route::post('events/media/update', [EventController::class, 'media_update'])->name('admin.events.media.update');
         Route::get('events/media/destroy/{id}', [EventController::class, 'media_destroy'])->name('admin.events.media.destroy');

        Route::get('events/get-type', [EventController::class, 'GetType'])->name('admin.events.get-type');

         //partners
        Route::get('partners', [PartnerController::class, 'index'])->name('admin.partners.index');
        Route::get('partners/create', [PartnerController::class, 'create'])->name('admin.partners.create');
        Route::get('partners/edit/{id}', [PartnerController::class, 'edit'])->name('admin.partners.edit');
        Route::get('partners/destroy/{id}', [PartnerController::class, 'destroy'])->name('admin.partners.destroy');
        Route::get('partners/change-status/{id}', [PartnerController::class, 'changeStatus'])->name('admin.partners.change-status');
        Route::post('partners/store', [PartnerController::class, 'store'])->name('admin.partners.store');
        Route::post('partners/update', [PartnerController::class, 'update'])->name('admin.partners.update');
        Route::get('partners/show/{id}', [PartnerController::class, 'show'])->name('admin.partners.show');

        //products
        Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::get('products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('products/change-status/{id}', [ProductController::class, 'changeStatus'])->name('admin.products.change-status');
        Route::post('products/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::post('products/update', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('products/show/{id}', [ProductController::class, 'show'])->name('admin.products.show');

        //job applications
        Route::get('job-applications', [JobApplicationController::class, 'index'])->name('admin.job-applications.index');
        Route::get('job-applications/create', function(){
            echo "Not possible";exit;
        })->name('admin.job-applications.create');
        Route::get('job-applications/edit/{id}', [JobApplicationController::class, 'edit'])->name('admin.job-applications.edit');
        Route::get('job-applications/destroy/{id}', [JobApplicationController::class, 'destroy'])->name('admin.job-applications.destroy');
        Route::post('job-applications/store', function(){
            echo "Not possible";exit;
        })->name('admin.job-applications.store');
        Route::post('job-applications/update', [JobApplicationController::class, 'update'])->name('admin.job-applications.update');
        Route::get('job-applications/change-status/{id}', [JobApplicationController::class, 'changeStatus'])->name('admin.job-applications.change-status');
        Route::get('job-applications/show/{id}', [JobApplicationController::class, 'show'])->name('admin.job-applications.show');


        //Listings
        Route::get('listings', [ListingController::class, 'index'])->name('admin.listings.index');
        Route::get('listings/create', [ListingController::class, 'create'])->name('admin.listings.create');
        Route::get('listings/edit/{id}', [ListingController::class, 'edit'])->name('admin.listings.edit');
        Route::get('listings/destroy/{id}', [ListingController::class, 'destroy'])->name('admin.listings.destroy');
        Route::post('listings/store', [ListingController::class, 'store'])->name('admin.listings.store');
        Route::post('listings/update', [ListingController::class, 'update'])->name('admin.listings.update');
        Route::get('listings/change-status/{id}', [ListingController::class, 'changeStatus'])->name('admin.listings.change-status');
        Route::get('listings/show/{id}', [ListingController::class, 'show'])->name('admin.listings.show');

        //Listing items
        Route::get('/listing-items/edit/{id}', [ListigItemController::class, 'edit'])->name('admin.listing-items.edit');
        Route::get('/listing-items/destroy/{id}', [ListigItemController::class, 'destroy'] )->name('admin.listing-items.destroy');
        Route::get('/listing-items/create/{listing_id}', [ListigItemController::class, 'create'])->name('admin.listing-items.create');
        Route::post('/listing-items/update', [ListigItemController::class, 'update'])->name('admin.listing-items.update');
        Route::get('/listing-items/change-status/{id}', [ListigItemController::class, 'changeStatus'])->name('admin.listing-items.change-status');
        Route::get('/listing-items/change-default/{id}', [ListigItemController::class, 'changedefault'])->name('admin.listing-items.change-default');
        Route::post('/listing-items/store', [ListigItemController::class, 'store'])->name('admin.listing-items.store');
        Route::get('/listing-items/{listing_id}', [ListigItemController::class, 'index'])->name('admin.listing-items.index');

        Route::get('/dynamic-listing/{listing_name}', [ListigItemController::class, 'dynamic_create'])->name('admin.dynamic-listing.create');


         //tags
         Route::get('tags', [TagController::class, 'index'])->name('admin.tags.index');
         Route::get('tags/create', [TagController::class, 'create'])->name('admin.tags.create');
         Route::get('tags/edit/{id}', [TagController::class, 'edit'])->name('admin.tags.edit');
         Route::get('tags/destroy/{id}', [TagController::class, 'destroy'])->name('admin.tags.destroy');
         Route::get('tags/change-status/{id}', [TagController::class, 'changeStatus'])->name('admin.tags.change-status');
         Route::post('tags/store', [TagController::class, 'store'])->name('admin.tags.store');
         Route::post('tags/update', [TagController::class, 'update'])->name('admin.tags.update');
         Route::get('tags/show/{id}', [TagController::class, 'show'])->name('admin.tags.show');

         //gallery
         Route::get('galleries', [GalleryController::class, 'index'])->name('admin.galleries.index');
         Route::get('galleries/create', [GalleryController::class, 'create'])->name('admin.galleries.create');
         Route::get('galleries/edit/{id}', [GalleryController::class, 'edit'])->name('admin.galleries.edit');
         Route::get('galleries/destroy/{id}', [GalleryController::class, 'destroy'])->name('admin.galleries.destroy');
         Route::get('galleries/change-status/{id}', [GalleryController::class, 'changeStatus'])->name('admin.galleries.change-status');
         Route::post('galleries/store', [GalleryController::class, 'store'])->name('admin.galleries.store');
         Route::post('galleries/update', [GalleryController::class, 'update'])->name('admin.galleries.update');
         Route::get('galleries/show/{id}', [GalleryController::class, 'show'])->name('admin.galleries.show');
         Route::get('galleries/media/edit/{id}/{type}', [GalleryController::class, 'media_edit'])->name('admin.galleries.media.edit');
         Route::post('galleries/media/update', [GalleryController::class, 'media_update'])->name('admin.galleries.media.update');
         Route::get('galleries/media/destroy/{id}', [GalleryController::class, 'media_destroy'])->name('admin.galleries.media.destroy');

         Route::get('galleries/get-type', [GalleryController::class, 'GetType'])->name('admin.galleries.get-type');


         //authors
        Route::get('authors', [AuthorController::class, 'index'])->name('admin.authors.index');
        Route::get('authors/create', [AuthorController::class, 'create'])->name('admin.authors.create');
        Route::get('authors/edit/{id}/{tab?}', [AuthorController::class, 'edit'])->name('admin.authors.edit');
        Route::get('authors/destroy/{id}', [AuthorController::class, 'destroy'])->name('admin.authors.destroy');
        Route::get('authors/change-status/{id}', [AuthorController::class, 'changeStatus'])->name('admin.authors.change-status');
        Route::post('authors/store', [AuthorController::class, 'store'])->name('admin.authors.store');
        Route::post('authors/update', [AuthorController::class, 'update'])->name('admin.authors.update');
        Route::get('authors/show/{id}', [AuthorController::class, 'show'])->name('admin.authors.show');



	});


    Route::get('/{id?}', [AuthenticateSessionOtpController::class, 'create'])->name('admin.auth.login');
});
