<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\SubscriberController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\FrontPageController;
use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CouponController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\InstructorController;
use App\Http\Controllers\Auth\UserAuth;
use App\Http\Controllers\Auth\InstructorAuth;


Route::get('/', [FrontController::class, 'home'])->name('front.home');

Route::middleware(['auth:web'])->prefix('user')->group(function () {
    Route::get('/dashboard',[UserController::class, 'dashboard'])->name('front.dashboard');
    Route::get('/my-profile',[UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile-update',[UserController::class, 'profileUpdate'])->name('user.profileUpdate');
    Route::post('/password-update',[UserController::class, 'passwordUpdate'])->name('user.passwordUpdate');
    
    Route::get('/order-details/{id}',[UserController::class, 'orderDetails'])->name('user.orderDetails');
    Route::get('/my-course',[UserController::class, 'myCourse'])->name('user.my-course');
    Route::get('/certificate',[UserController::class, 'certificate'])->name('user.certificate');
    Route::get('/logout', [UserAuth::class, 'logout'])->name('user.logout');
});


Route::fallback(function () {
    return response()->view('front.404');
});


Route::post('add-subscribers', [SubscriberController::class, 'insert'])->name('front.addSuscriber');


// ---- ** Login & Registration ***** ----- //
Route::get('/login', [UserAuth::class, 'renderLogin'])->name('login');
Route::post('/login-submit', [UserAuth::class, 'loginAction'])->name('front.login');

Route::get('/register', [UserAuth::class, 'register'])->name('front.UserRegister');
Route::post('/register-submit', [UserAuth::class, 'registerAction'])->name('front.register');

Route::get('/verify-email/{token}', [UserAuth::class, 'verifyEmail'])->name('front.verify.mail');

Route::get('/forget-password', [UserAuth::class, 'forget'])->name('front.UserForget');
Route::post('/forgot-password/send-otp', [UserAuth::class, 'sendOtp'])->name('front.forgot.send');
Route::post('/forgot-password/verify-otp', [UserAuth::class, 'verifyOtp'])->name('front.forgot.verify');
Route::post('/forgot-password/reset-password', [UserAuth::class, 'resetPassword'])->name('front.forgot.resetPassword');


// ---- ** Products ***** ----- //
Route::get('/course', [CatalogController::class, 'index'])->name('front.course'); 
Route::get('/course/{slug}', [CatalogController::class, 'single'])->name('front.course-single');
Route::get('/course-view/{slug}', [CatalogController::class, 'single2'])->name('front.course-single2');
Route::middleware('auth')->get('/lesson/video/{lesson}', [CatalogController::class, 'showLesson'])->name('front.lesson.video');



// Blog start
Route::get('/blog/search', [BlogController::class, 'blogSearch'])->name('front.blog.search');
Route::get('/blog/tag/{tag}', [BlogController::class, 'blogTag'])->name('front.blog.tag');
Route::get('/blog/category/{category}', [BlogController::class, 'blogCategory'])->name('front.blog.category');
Route::post('/blog/comment/{blog}', [BlogController::class, 'commentAdd'])->name('front.blog.commentAdd');

Route::get('/blog', [BlogController::class, 'blog'])->name('front.blog');
Route::get('/blog/{slug}', [BlogController::class, 'blogSingle'])->name('front.blog-single');
// Blog end

// Cart start
Route::get('/cart', [CartController::class, 'index'])->name('front.cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('front.cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/coupon/apply', [CouponController::class, 'applyCoupon'])->name('coupon.apply');
Route::post('/coupon/cancel', [CouponController::class, 'cancelCoupon'])->name('coupon.cancel');
// Cart end

// Checkout start
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('front.checkout');
Route::post('/payment', [CheckoutController::class, 'pay'])->name('front.pay');
Route::get('/thank-you', function () {
    return view('front.thankyou');
})->name('front.thankyou');
Route::get('/mcq', function () {
    return view('front.mcq');
})->name('front.mcq');



Route::get('/contact', [FrontPageController::class, 'contactPage'])->name('front.contact');
Route::post('/contact-submit', [FrontPageController::class, 'contactFrom'])->name('front.contactFrom');






// ************* Instructor Routes ************* //
Route::get('/instructor/login', [InstructorAuth::class, 'instructorLogin'])->name('instructor.login');
Route::post('instructor/login-submit', [InstructorAuth::class, 'loginAction'])->name('instructor.login.submit');

Route::get('instructor/forget-password', [InstructorAuth::class, 'forget'])->name('instructor.UserForget');
Route::post('instructor/forgot-password/send-otp', [InstructorAuth::class, 'sendOtp'])->name('instructor.forgot.send');
Route::post('instructor/forgot-password/verify-otp', [InstructorAuth::class, 'verifyOtp'])->name('instructor.forgot.verify');
Route::post('instructor/forgot-password/reset-password', [InstructorAuth::class, 'resetPassword'])->name('instructor.forgot.resetPassword');

Route::middleware(['auth:instructor'])->prefix('instructor')->group(function () {
    Route::get('/dashboard',[InstructorController::class, 'dashboard'])->name('instructor.dashboard');
    Route::get('/my-profile',[InstructorController::class, 'profile'])->name('instructor.profile');
    Route::post('/profile-update',[InstructorController::class, 'profileUpdate'])->name('instructor.profileUpdate');
    Route::post('/password-update',[InstructorController::class, 'passwordUpdate'])->name('instructor.passwordUpdate');
    
    Route::get('/order-details/{id}',[InstructorController::class, 'orderDetails'])->name('instructor.orderDetails');
    Route::get('/my-course',[InstructorController::class, 'myCourse'])->name('instructor.my-course');
    Route::get('/certificate',[InstructorController::class, 'certificate'])->name('instructor.certificate');
    Route::get('/logout', [InstructorAuth::class, 'logout'])->name('instructor.logout');
    
    
    
    
            //-------- Category-------//
    Route::get('/categories', [CategoryController::class, 'index'])->name('instructor.category');
    Route::post('/category-add', [CategoryController::class, 'addCategory'])->name('instructor.addCategory');
    Route::post('/category-update', [CategoryController::class, 'updateCategory'])->name('instructor.updateCategory');
    Route::post('/category-header-status', [CategoryController::class, 'toggleHeaderStatus'])->name('instructor.category.show-in-header');
    Route::post('/category-status-update', [CategoryController::class, 'toggleStatus'])->name('instructor.category.status');
    Route::post('/category-delete', [CategoryController::class, 'delete'])->name('instructor.category.delete');
    
        //-------- Subcategory ---------//
    Route::get('/subcategories/{slug?}', [SubcategoryController::class, 'index'])->name('instructor.subcategory');
    Route::prefix('/subcategory')->name('instructor.subcategory.')->group(function () {
        Route::post('/create', [SubcategoryController::class, 'create'])->name('create');
        Route::post('/update', [SubcategoryController::class, 'update'])->name('update');
        Route::post('/header-status', [SubcategoryController::class, 'toggleHeaderStatus'])->name('show-in-header');
        Route::post('/status-update', [SubcategoryController::class, 'toggleStatus'])->name('status');
        Route::post('/delete', [SubcategoryController::class, 'delete'])->name('delete');
    });
    
        //-------- Tags ---------//
    Route::get('/tags', [TagController::class, 'index'])->name('instructor.tag');
    Route::prefix('/tag')->name('instructor.tag.')->group(function () {
        Route::post('/create', [TagController::class, 'create'])->name('create');
        Route::post('/update', [TagController::class, 'update'])->name('update');
        Route::post('/status-update', [TagController::class, 'toggleStatus'])->name('status');
        Route::post('/delete', [TagController::class, 'delete'])->name('delete');
    });
    
        //-------- Course ---------//
    Route::get('/courses/{slug?}', [CourseController::class, 'show'])->name('instructor.courses');
    Route::prefix('/course')->name('instructor.course.')->group(function () {
        Route::get('/add', [CourseController::class, 'index'])->name('add');
        Route::post('/create', [CourseController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
        Route::get('/view/{id}', [CourseController::class, 'view'])->name('view');
        Route::post('/delete', [CourseController::class, 'delete'])->name('delete');
        
        // --- Syllabus --- //
        Route::get('/{id}/syllabus', [CourseController::class, 'syllabus'])->name('syllabus');
        Route::get('/{id}/syllabus/add', [CourseController::class, 'syllabusAdd'])->name('syllabus.add');
        Route::post('/syllabus/create', [CourseController::class, 'syllabusCreate'])->name('syllabus.create');
        Route::get('/syllabus/edit/{id}', [CourseController::class, 'syllabusEdit'])->name('syllabus.edit');
        Route::post('/syllabus/update', [CourseController::class, 'syllabusUpdate'])->name('syllabus.update');
        Route::post('/syllabus/delete', [CourseController::class, 'syllabusDelete'])->name('syllabus.delete');
        Route::post('/syllabus/sort', [CourseController::class, 'syllabusSort'])->name('syllabus.sort');


    });
    Route::prefix('/syllabus')->name('instructor.syllabus.')->group(function () {
        // --- Lesson --- //
        Route::get('/{id}/lesson', [CourseController::class, 'lesson'])->name('lesson');
        Route::get('/{id}/lesson/add', [CourseController::class, 'lessonAdd'])->name('lesson.add');
        Route::post('/lesson/create', [CourseController::class, 'lessonCreate'])->name('lesson.create');
        Route::get('/lesson/edit/{id}', [CourseController::class, 'lessonEdit'])->name('lesson.edit');
        Route::post('/lesson/update', [CourseController::class, 'lessonUpdate'])->name('lesson.update');
        Route::post('/lesson/delete', [CourseController::class, 'lessonDelete'])->name('lesson.delete');
        Route::post('/lesson/sort', [CourseController::class, 'lessonSort'])->name('lesson.sort');

    });
    
    Route::post('/lesson/mcq/store', [CourseController::class, 'mcqStore'])->name('admin.mcq.store');
    Route::get('/lesson/mcq/edit/{id}', [CourseController::class, 'mcqEdit'])->name('admin.mcq.edit');
    Route::post('/lesson/mcq/update', [CourseController::class, 'mcqUpdate'])->name('admin.mcq.update');
    Route::post('/lesson/mcq/delete', [CourseController::class, 'mcqDelete'])->name('admin.mcq.delete');
    
});





 