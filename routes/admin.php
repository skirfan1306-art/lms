<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuth;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Front\SubscriberController;


use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache-now', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'Laravel cache cleared.';
});

// Mail Templates
Route::prefix('admin/mail-templates/')->group(function () {
Route::get('admin-forgot-otp', function () { return view('mailTemplates.adminForgotOtp');});
Route::get('admin-register', function () { return view('mailTemplates.adminRegister');});

Route::get('user-wellcome', function () { return view('mailTemplates.userWellcome');});
Route::get('user-mail-verification', function () { return view('mailTemplates.userMailVerification');});

});

Route::prefix('admin')->group(function () {

    Route::get('form', function () { return view('admin.form'); });
    Route::get('table', function () { return view('admin.table'); });

    // Login Register
    Route::get('login', [PageController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminAuth::class, 'loginAction'])->name('admin.login.action');
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
    // ----- ** Superadmin Access Start ***** -----//
    Route::get('manage-admin', [PageController::class, 'manageAdmin'])->name('admin.admins')->middleware('isAdmin:superadmin');
    Route::post('add-admin', [AdminController::class, 'addAdmin'])->name('admin.admins.add');
    Route::post('status-admin', [AdminController::class, 'status'])->name('admin.admins.status');
    Route::post('update-admin', [AdminController::class, 'updateAdmin'])->name('admin.admins.update');
    Route::post('delete-admin', [AdminController::class, 'deleteAdmin'])->name('admin.admins.delete');
    Route::get('site-setting', [PageController::class, 'siteSetting'])->name('admin.sitesetting')->middleware('isAdmin:superadmin');
    Route::post('site-setting-update', [SitesettingController::class, 'siteUpdate'])->name('admin.sitesetting.update');
    Route::get('mail-setting', [PageController::class, 'mailSetting'])->name('admin.mailsetting')->middleware('isAdmin:superadmin');
    Route::post('mail-settings', [SitesettingController::class, 'mailUpdate'])->name('admin.mailsetting.update');

    // ----- ** Superadmin Access End ***** -----//

    Route::get('/', [PageController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('profile-settings', [PageController::class, 'profile'])->name('admin.profile');
    Route::post('profile-settings-update/{id}', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::post('profile-password-update/{id}', [AdminController::class, 'changepassword'])->name('admin.profile.changepassword');
    
    Route::get('subscribers', [SubscriberController::class, 'index'])->name('admin.subscribers');
    Route::post('subscribers-delete',[SubscriberController::class, 'delete'])->name('admin.subscribers.delete');
    
    // --------- ** Blog Start** --------------//
    Route::get('add-blog', [BlogController::class, 'index'])->name('admin.blog.form');
    Route::get('blogs', [BlogController::class, 'show'])->name('admin.blogs');
    Route::post('blog-create',[BlogController::class, 'create'])->name('admin.blog.create');
    Route::get('blog-edit/{id}',[BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('blog-update',[BlogController::class, 'update'])->name('admin.blog.update');
    Route::post('blog-delete',[BlogController::class, 'delete'])->name('admin.blog.delete');
    // --------- ** Blog End** --------------//
    
    
    // --------- ** Product Routes Start ***** ---------------//
        //-------- Category-------//
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('category-add', [CategoryController::class, 'addCategory'])->name('admin.addCategory');
    Route::post('category-update', [CategoryController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::post('category-status-update', [CategoryController::class, 'toggleStatus'])->name('admin.category.status');
    Route::post('category-delete', [CategoryController::class, 'delete'])->name('admin.category.delete');
    
        //-------- Brand ---------//
    Route::get('brands', [BrandController::class, 'index'])->name('admin.brand');
    Route::prefix('brand')->name('admin.brand.')->group(function () {
        Route::post('create', [BrandController::class, 'create'])->name('create');
        Route::post('update', [BrandController::class, 'update'])->name('update');
        Route::post('status-update', [BrandController::class, 'toggleStatus'])->name('status');
        Route::post('delete', [BrandController::class, 'delete'])->name('delete');
    });

    
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
    
    // --------- ** Appointment Routes Start ***** ---------------//
    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointment');
    Route::post('appointment', [AdminAppointmentController::class, 'search'])->name('admin.appointment.search');
    // --------- ** Appointment Routes End ***** ---------------//
    
    
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
    
});


