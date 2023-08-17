<?php

use App\Http\Controllers\Ajax\AjaxCourseController;
use App\Http\Controllers\Ajax\AjaxProfileController;
use App\Http\Controllers\Ajax\AjaxTrialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangeLanguageController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\CourseController;
use App\Http\Controllers\User\HomepageController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SocialAuthController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckLogoutMiddleware;
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
Route::group([
    'middleware' => CheckLogoutMiddleware::class,
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('processRegister');

//    social
    Route::get('/redirect/{social}', [SocialAuthController::class, 'redirect'])->name('login.social.redirect');
    Route::get('/callback/{social}', [SocialAuthController::class, 'callback'])->name('login.social.callback');
});

Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/verifyEmail', [AuthController::class, 'verifyEmail'])->name('verifyEmail');

//    Order
    Route::get('/order/{course}', [OrderController::class, 'index'])->name('order');
    Route::post('/order/payment/{course}', [OrderController::class, 'order'])->name('order.payment');
//vnpay
    Route::get('/checkout/vnpay/{order}', [CheckoutController::class, 'vnpay'])->name('checkout.vnpay');
    Route::get('/checkout/return-vnpay', [CheckoutController::class, 'processVnpay'])->name('return.vnpay');
//momo
    Route::get('/checkout/momo/{order}', [CheckoutController::class, 'momo'])->name('checkout.momo');
    Route::get('/checkout/return-momo', [CheckoutController::class, 'processMomo'])->name('return.momo');

    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::post('/verifyEmail', [AjaxProfileController::class, 'verifyEmail'])->name('verifyEmail');
        Route::post('/trial', [AjaxTrialController::class, 'subscribe'])->name('trial.subscribe');

        Route::get('/courses', [AjaxCourseController::class, 'getCourses'])->name('course.getCourses');
        Route::get('/courses/get-new', [AjaxCourseController::class, 'getNewCourses'])->name('course.getNew');
        Route::get('/courses/get-top-relate', [AjaxCourseController::class, 'getTopRelate'])->name('course.getTopRelate');
    });
});
Route::get('/', [HomepageController::class, '__invoke'])->name('index');
Route::get('/pricing', [PricingController::class, '__invoke'])->name('pricing');
Route::get('/course', [CourseController::class, 'index'])->name('course');
Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');

//Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

//Language
Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', [ChangeLanguageController::class, '__invoke'])->name('change-language');
});

Route::get('/test', [TestController::class, 'test'])->name('test');
