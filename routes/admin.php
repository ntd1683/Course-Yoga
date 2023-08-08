<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Ajax\AjaxCourseController;
use App\Http\Controllers\Ajax\AjaxUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
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
    Route::post('/profile', [SettingController::class, 'storeProfile'])->name('profile.store');

    Route::resource('course', CourseController::class);
});

Route::group([
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('user/get-lecturers', [AjaxUserController::class, 'lecturers'])->name('user.search.lecturers');

        Route::delete('course/destroy/{course}', [AjaxCourseController::class, 'destroy'])->name('course.destroy');
        Route::get('course', [AjaxCourseController::class, 'index'])->name('course');
        Route::get('course/title', [AjaxCourseController::class, 'title'])->name('course.search.title');
    });
});

