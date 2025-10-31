<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\SubscriberController;
use App\Http\Controllers\Front\FrontPageController;
use App\Http\Controllers\Auth\UserAuth;

Route::get('/', function () {
    return view('front.index');
})->name('front.home');

Route::get('/dashboard', function () {
    return view('front.dashboard');
})->name('front.dashboard');


Route::post('add-subscribers', [SubscriberController::class, 'insert'])->name('front.addSuscriber');


// ---- ** Login & Registration ***** ----- //
Route::post('/login', [UserAuth::class, 'loginAction'])->name('front.login');

Route::post('/register', [UserAuth::class, 'registerAction'])->name('front.register');
Route::get('/verify-email/{token}', [UserAuth::class, 'verifyEmail'])->name('front.verify.mail');

// ---- ** Products ***** ----- //
Route::get('products/{category?}', [FrontPageController::class, 'products'])->name('front.products');
