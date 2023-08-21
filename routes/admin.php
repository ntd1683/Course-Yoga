<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TrialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Ajax\AjaxChartJs;
use App\Http\Controllers\Ajax\AjaxContactController;
use App\Http\Controllers\Ajax\AjaxCourseController;
use App\Http\Controllers\Ajax\AjaxDiscountController;
use App\Http\Controllers\Ajax\AjaxLessonController;
use App\Http\Controllers\Ajax\AjaxOrderController;
use App\Http\Controllers\Ajax\AjaxSubscriptionController;
use App\Http\Controllers\Ajax\AjaxTrialController;
use App\Http\Controllers\Ajax\AjaxUserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckLecturerMiddleware;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckLogoutMiddleware;


Route::group([
    'middleware' => CheckLogoutMiddleware::class,
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('processRegister');
});

Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group([
    'middleware' => CheckLecturerMiddleware::class,
], function () {
    Route::get('/', [HomepageController::class, '__invoke'])->name('index');
    Route::get('/profile', [SettingController::class, 'profile'])->name('profile');
    Route::post('/profile', [SettingController::class, 'updateProfile'])->name('profile.store');

    Route::resource('course', CourseController::class);
    Route::resource('lesson', LessonController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('trial', TrialController::class);
    Route::resource('subscribe', SubscriptionController::class)->parameters([
        'subscribe' => 'subscription'
    ]);
    Route::resource('order', OrderController::class);
    Route::resource('discount', DiscountController::class);

    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('course', [AjaxCourseController::class, 'index'])->name('course');
        Route::get('course/title', [AjaxCourseController::class, 'title'])->name('course.search.title');
        Route::get('course/lessons', [AjaxCourseController::class, 'lessons'])->name('course.search.lessons');
        Route::get('course/users', [AjaxCourseController::class, 'users'])->name('course.search.users');

        Route::get('lesson', [AjaxLessonController::class, 'index'])->name('lesson');
        Route::get('lesson/title', [AjaxLessonController::class, 'title'])->name('lesson.search.title');

        Route::get('order', [AjaxOrderController::class, 'index'])->name('order');
        Route::get('order/code', [AjaxOrderController::class, 'code'])->name('order.search.code');
        Route::get('order/name', [AjaxOrderController::class, 'name'])->name('order.search.name');
        Route::get('order/course', [AjaxOrderController::class, 'course'])->name('order.search.title');
        Route::get('order/referral-code', [AjaxOrderController::class, 'referralCode'])->name('order.search.referral-code');

        Route::get('discount', [AjaxDiscountController::class, 'index'])->name('discount');
        Route::get('discount/code', [AjaxDiscountController::class, 'code'])->name('discount.search.code');
        Route::get('discount/name', [AjaxDiscountController::class, 'name'])->name('discount.search.name');
        Route::get('discount/user', [AjaxDiscountController::class, 'user'])->name('discount.search.user');

        Route::get('trial', [AjaxTrialController::class, 'index'])->name('trial');
        Route::get('trial/phone', [AjaxTrialController::class, 'phone'])->name('trial.search.phone');

        Route::get('contact', [AjaxContactController::class, 'index'])->name('contact');
        Route::get('contact/title', [AjaxContactController::class, 'title'])->name('contact.search.title');
        Route::get('contact/name', [AjaxContactController::class, 'name'])->name('contact.search.name');

        Route::get('subscription', [AjaxSubscriptionController::class, 'index'])->name('subscribe');
        Route::get('subscription/course', [AjaxSubscriptionController::class, 'course'])->name('subscribe.search.course');
        Route::get('subscription/name', [AjaxSubscriptionController::class, 'name'])->name('subscribe.search.name');
        Route::get('subscription/email', [AjaxSubscriptionController::class, 'email'])->name('subscribe.search.email');
    });
});

Route::group([
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::resource('user', UserController::class);
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::prefix('ajax')->name('ajax.')->group(function () {
//        Homepage
        Route::get('chart-js/revenue', [AjaxChartJs::class, 'revenue'])->name('chart-js.revenue');

        Route::get('user', [AjaxUserController::class, 'index'])->name('users');
        Route::get('user/get-lecturers', [AjaxUserController::class, 'lecturers'])->name('user.search.lecturers');
        Route::get('user/get-name', [AjaxUserController::class, 'name'])->name('users.search.name');
        Route::delete('user/destroy/{user}', [AjaxUserController::class, 'destroy'])->name('user.destroy');

        Route::delete('course/destroy/{course}', [AjaxCourseController::class, 'destroy'])->name('course.destroy');

        Route::delete('lesson/destroy/{lesson}', [AjaxLessonController::class, 'destroy'])->name('lesson.destroy');

        Route::delete('discount/destroy/{discount}', [AjaxDiscountController::class, 'destroy'])->name('discount.destroy');

        Route::delete('contact/destroy/{contact}', [AjaxContactController::class, 'destroy'])->name('contact.destroy');

        Route::delete('trial/destroy/{trial}', [AjaxTrialController::class, 'destroy'])->name('trial.destroy');

        Route::delete('subscription/destroy/{subscription}', [AjaxSubscriptionController::class, 'destroy'])->name('subscribe.destroy');
    });
});

