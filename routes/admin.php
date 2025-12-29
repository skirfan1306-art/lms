<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\AdminAuth;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Front\SubscriberController;


use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache-now', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'Laravel cache cleared.';
});

Route::get('/sessions', function () {
    return Session::all();
});

// Mail Templates
Route::prefix('admin/mail-templates/')->group(function () {
Route::get('admin-forgot-otp', function () { return view('mailTemplates.adminForgotOtp');});
Route::get('admin-register', function () { return view('mailTemplates.adminRegister');});

Route::get('user-welcome', function () { return view('mailTemplates.userWellcome');});
Route::get('user-mail-verification', function () { return view('mailTemplates.userMailVerification');});

Route::get('instructor-welcome', function () { return view('mailTemplates.instructorWelcome');});

});

Route::prefix('admin')->group(function () {

    Route::get('form', function () { return view('admin.form'); });
    Route::get('table', function () { return view('admin.table'); });

    // Login Register
    Route::get('login', [PageController::class, 'login'])->name('admin.login');
    Route::post('login-action', [AdminAuth::class, 'loginAction'])->name('admin.login.action');
    Route::get('register/{email}', [PageController::class, 'register'])->name('admin.register');
    Route::post('register', [AdminAuth::class, 'registerAction'])->name('admin.register.action');
    Route::get('logout', [AdminAuth::class, 'logout'])->name('admin.logout');
    // Forgot Password
    Route::get('forgot', [PageController::class, 'forgot'])->name('admin.forgot');
    Route::post('forgot-sendOtp', [AdminAuth::class, 'sendOtp'])->name('admin.forgot.send');    
    // OTP Verify
    Route::get('otp/{email}', [PageController::class, 'otpForm'])->name('admin.forgot.otp');
    Route::post('verify-otp', [AdminAuth::class, 'verifyOtp'])->name('admin.forgot.otp.verify');
    // Reset Password
    Route::get('reset-password', [PageController::class, 'resetForm'])->name('admin.password.reset');
    Route::post('reset-password', [AdminAuth::class, 'resetPassword'])->name('admin.password.update');


});


Route::middleware(['isLogin', 'isActive'])->prefix('admin')->group(function () {
    
    Route::get('/', [PageController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('profile-settings', [PageController::class, 'profile'])->name('admin.profile');
    Route::post('profile-settings-update/{id}', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::post('profile-password-update/{id}', [AdminController::class, 'changepassword'])->name('admin.profile.changepassword');
    
    Route::get('subscribers', [SubscriberController::class, 'index'])->name('admin.subscribers');
    Route::post('subscribers-delete',[SubscriberController::class, 'delete'])->name('admin.subscribers.delete');
    
// ----- ** Superadmin Access Start ***** -----//
Route::get('manage-admin', [PageController::class, 'manageAdmin'])->name('admin.admins')->middleware('isAdmin:superadmin');
Route::prefix('admin')->name('admin.admins.')->middleware('isAdmin:superadmin')->group(function () {
    Route::post('add', [AdminController::class, 'addAdmin'])->name('add');
    Route::post('update', [AdminController::class, 'updateAdmin'])->name('update');
    Route::post('status', [AdminController::class, 'status'])->name('status');
    Route::post('delete', [AdminController::class, 'deleteAdmin'])->name('delete');
});

    
    Route::get('site-setting', [PageController::class, 'siteSetting'])->name('admin.sitesetting')->middleware('isAdmin:superadmin');
    Route::post('site-setting-update', [SitesettingController::class, 'siteUpdate'])->name('admin.sitesetting.update');
    Route::get('mail-setting', [PageController::class, 'mailSetting'])->name('admin.mailsetting')->middleware('isAdmin:superadmin');
    Route::post('mail-settings', [SitesettingController::class, 'mailUpdate'])->name('admin.mailsetting.update');

// ----- ** Superadmin Access End ***** -----//

Route::get('instructors', [InstructorController::class, 'show'])->name('admin.instructors');
Route::prefix('instructor')->name('admin.instructor.')->group(function () {
    Route::get('add', [InstructorController::class, 'index'])->name('add');
    Route::post('create', [InstructorController::class, 'create'])->name('create');
    Route::get('edit/{id}', [InstructorController::class, 'edit'])->name('edit');
    Route::post('update', [InstructorController::class, 'update'])->name('update');
    Route::post('update-pass', [InstructorController::class, 'passupdate'])->name('passupdate');
    Route::post('status', [InstructorController::class, 'status'])->name('status');
    Route::get('view/{id}', [InstructorController::class, 'view'])->name('view');
    Route::post('delete', [InstructorController::class, 'delete'])->name('delete');
});

Route::get('users', [UserController::class, 'show'])->name('admin.users');
Route::prefix('user')->name('admin.user.')->group(function () {
    Route::post('add', [UserController::class, 'addAdmin'])->name('add');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('update', [UserController::class, 'update'])->name('update');
    Route::post('update-pass', [UserController::class, 'passupdate'])->name('passupdate');
    Route::post('status', [UserController::class, 'status'])->name('status');
    Route::post('delete', [UserController::class, 'delete'])->name('delete');
});
    
    
    // --------- ** Blog Start** --------------//
    Route::get('add-blog', [BlogController::class, 'index'])->name('admin.blog.form');
    Route::get('blogs', [BlogController::class, 'show'])->name('admin.blogs');
    Route::post('blog-create',[BlogController::class, 'create'])->name('admin.blog.create');
    Route::get('blog-edit/{id}',[BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('blog-update',[BlogController::class, 'update'])->name('admin.blog.update');
    Route::post('blog-delete',[BlogController::class, 'delete'])->name('admin.blog.delete');
    
    Route::get('blog-categories', [BlogController::class, 'categoryIndex'])->name('admin.blog.category');
    Route::post('blog-category-add', [BlogController::class, 'addCategory'])->name('admin.blog.addCategory');
    Route::post('blog-category-update', [BlogController::class, 'updateCategory'])->name('admin.blog.updateCategory');
    Route::post('blog-category-status-update', [BlogController::class, 'categoryStatus'])->name('admin.blog.categoryStatus');
    Route::post('blog-category-delete', [BlogController::class, 'categoryDelete'])->name('admin.blog.categoryDelete');
    
    Route::get('blog-comments/{id}', [BlogController::class, 'comments'])->name('admin.blog.comments');
    Route::post('blog-comments-status-update', [BlogController::class, 'commentStatus'])->name('admin.blog.commentStatus');
    Route::post('blog-comments-delete', [BlogController::class, 'commentDelete'])->name('admin.blog.comment.delete');
    // --------- ** Blog End** --------------//
    
    
    // --------- ** Course & Product Routes Start ***** ---------------//
        //-------- Category-------//
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('category-add', [CategoryController::class, 'addCategory'])->name('admin.addCategory');
    Route::post('category-update', [CategoryController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::post('category-header-status', [CategoryController::class, 'toggleHeaderStatus'])->name('admin.category.show-in-header');
    Route::post('category-status-update', [CategoryController::class, 'toggleStatus'])->name('admin.category.status');
    Route::post('category-delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
    
        //-------- Subcategory ---------//
    Route::get('subcategories/{slug?}', [SubcategoryController::class, 'index'])->name('admin.subcategory');
    Route::prefix('subcategory')->name('admin.subcategory.')->group(function () {
        Route::post('create', [SubcategoryController::class, 'create'])->name('create');
        Route::post('update', [SubcategoryController::class, 'update'])->name('update');
        Route::post('header-status', [SubcategoryController::class, 'toggleHeaderStatus'])->name('show-in-header');
        Route::post('status-update', [SubcategoryController::class, 'toggleStatus'])->name('status');
        Route::post('delete', [SubcategoryController::class, 'delete'])->name('delete');
    });
    
        //-------- Tags ---------//
    Route::get('tags', [TagController::class, 'index'])->name('admin.tag');
    Route::prefix('tag')->name('admin.tag.')->group(function () {
        Route::post('create', [TagController::class, 'create'])->name('create');
        Route::post('update', [TagController::class, 'update'])->name('update');
        Route::post('status-update', [TagController::class, 'toggleStatus'])->name('status');
        Route::post('delete', [TagController::class, 'delete'])->name('delete');
    });
    
        //-------- Course ---------//
    Route::get('courses/{slug?}', [CourseController::class, 'show'])->name('admin.courses');
    Route::prefix('course')->name('admin.course.')->group(function () {
        Route::get('add', [CourseController::class, 'index'])->name('add');
        Route::post('create', [CourseController::class, 'create'])->name('create');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CourseController::class, 'update'])->name('update');
        Route::get('view/{id}', [CourseController::class, 'view'])->name('view');
        Route::post('delete', [CourseController::class, 'delete'])->name('delete');
        
        // --- Syllabus --- //
        Route::get('{id}/syllabus', [CourseController::class, 'syllabus'])->name('syllabus');
        Route::get('{id}/syllabus/add', [CourseController::class, 'syllabusAdd'])->name('syllabus.add');
        Route::post('syllabus/create', [CourseController::class, 'syllabusCreate'])->name('syllabus.create');
        Route::get('syllabus/edit/{id}', [CourseController::class, 'syllabusEdit'])->name('syllabus.edit');
        Route::post('syllabus/update', [CourseController::class, 'syllabusUpdate'])->name('syllabus.update');
        Route::post('syllabus/delete', [CourseController::class, 'syllabusDelete'])->name('syllabus.delete');
        Route::post('syllabus/sort', [CourseController::class, 'syllabusSort'])->name('syllabus.sort');


    });
    Route::prefix('syllabus')->name('admin.syllabus.')->group(function () {
        // --- Lesson --- //
        Route::get('{id}/lesson', [CourseController::class, 'lesson'])->name('lesson');
        Route::get('{id}/lesson/add', [CourseController::class, 'lessonAdd'])->name('lesson.add');
        Route::post('lesson/create', [CourseController::class, 'lessonCreate'])->name('lesson.create');
        Route::get('lesson/edit/{id}', [CourseController::class, 'lessonEdit'])->name('lesson.edit');
        Route::post('lesson/update', [CourseController::class, 'lessonUpdate'])->name('lesson.update');
        Route::post('lesson/delete', [CourseController::class, 'lessonDelete'])->name('lesson.delete');
        Route::post('lesson/sort', [CourseController::class, 'lessonSort'])->name('lesson.sort');

    });
    
    Route::post('/lesson/mcq/store', [CourseController::class, 'mcqStore'])->name('admin.mcq.store');
    Route::get('/lesson/mcq/edit/{id}', [CourseController::class, 'mcqEdit'])->name('admin.mcq.edit');
    Route::post('/lesson/mcq/update', [CourseController::class, 'mcqUpdate'])->name('admin.mcq.update');
    Route::post('/lesson/mcq/delete', [CourseController::class, 'mcqDelete'])->name('admin.mcq.delete');


        //-------- Product ---------//
    Route::get('products', [ProductController::class, 'show'])->name('admin.products');
    Route::prefix('product')->name('admin.product.')->group(function () {
        Route::get('add', [ProductController::class, 'index'])->name('add');
        Route::post('create', [ProductController::class, 'create'])->name('create');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('view/{id}', [ProductController::class, 'view'])->name('view');
    });
    
    // --------- ** Product Routes End ***** ---------------//
    
    // --------- ** Branch Routes Start ***** ---------------//
    Route::get('branches', [BranchController::class, 'index'])->name('admin.branch');
    Route::prefix('branch')->name('admin.branch.')->group(function () {
        Route::post('create', [BranchController::class, 'create'])->name('create');
        Route::post('update', [BranchController::class, 'update'])->name('update');
        Route::post('status-update', [BranchController::class, 'toggleStatus'])->name('status');
        Route::post('delete', [BranchController::class, 'delete'])->name('delete');
    });
    // --------- ** Branch Routes End ***** ---------------//
    
    // ----- ** Coupon Start ***** -----//
Route::get('coupon', [AdminCouponController::class, 'index'])->name('admin.coupon');
Route::prefix('admin')->name('admin.coupon.')->group(function () {
    Route::post('add', [AdminCouponController::class, 'create'])->name('create');
    Route::post('update', [AdminCouponController::class, 'update'])->name('update');
    Route::post('status', [AdminCouponController::class, 'status'])->name('status');
    Route::post('delete', [AdminCouponController::class, 'delete'])->name('delete');
});
    
    
    // --------- ** Home page Slider Start** --------------//
    Route::get('home-banner', [HomeController::class, 'showBanners'])->name('admin.showbanners');
    Route::post('add-homeslider',[HomeController::class, 'addBanner'])->name('admin.addbanners');
    Route::post('update-homeslider',[HomeController::class, 'updateBanner'])->name('admin.updatebanners');
    Route::post('updataHomeSliderStatus/{id}',[HomeController::class, 'homebannerstatus'])->name('admin.homebannerstatus');
    // --------- ** Home page Slider End** --------------//
    
    
    // --------- ** Contact Page Setting Start ***** --------------//
    Route::get('contact-page', [ContactController::class, 'index'])->name('admin.contactPageSetting');
    Route::post('update-contact-page',[ContactController::class, 'update'])->name('admin.contactSetting.update');
    Route::get('contact-form', [ContactController::class, 'form'])->name('admin.contactForm');
    Route::post('contact-form-delete', [ContactController::class, 'formDelete'])->name('admin.contactForm.delete');
    // --------- ** Contact Page Setting End ***** --------------//
    
    // --------- ** Services  Start ***** --------------//
    Route::get('service-form',[ServiceController::class, 'form'])->name('admin.serviceForm');
    Route::post('service-add',[ServiceController::class, 'addService'])->name('admin.addService');
    Route::get('service-table',[ServiceController::class, 'serviceTable'])->name('admin.serviceTable');
    Route::post('service-status-update',[ServiceController::class, 'toggleStatus'])->name('admin.service.status');
    Route::get('service-edit/{id}',[ServiceController::class, 'edit'])->name('admin.service.edit');
    Route::post('service-update/{id}', [ServiceController::class, 'update'])->name('admin.service.update');
    Route::post('service-delete', [ServiceController::class, 'delete'])->name('admin.service.delete');
    // --------- ** Services  End ***** --------------//
    
    
        // ----- ** Order Start ***** -----//
Route::get('orders', [OrderController::class, 'index'])->name('admin.order');
Route::prefix('admin')->name('admin.order.')->group(function () {
    Route::post('add', [OrderController::class, 'create'])->name('create');
    Route::post('update', [OrderController::class, 'update'])->name('update');
    Route::post('status', [OrderController::class, 'status'])->name('status');
    Route::post('delete', [OrderController::class, 'delete'])->name('delete');
    Route::get('view/{id}', [OrderController::class, 'view'])->name('view');
});
    
});


