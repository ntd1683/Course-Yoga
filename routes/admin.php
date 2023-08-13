<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Ajax\AjaxContactController;
use App\Http\Controllers\Ajax\AjaxCourseController;
use App\Http\Controllers\Ajax\AjaxLessonController;
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

    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('course', [AjaxCourseController::class, 'index'])->name('course');
        Route::get('course/title', [AjaxCourseController::class, 'title'])->name('course.search.title');

        Route::get('lesson', [AjaxLessonController::class, 'index'])->name('lesson');
        Route::get('lesson/title', [AjaxLessonController::class, 'title'])->name('lesson.search.title');

        Route::get('contact', [AjaxContactController::class, 'index'])->name('contact');
        Route::get('contact/title', [AjaxContactController::class, 'title'])->name('contact.search.title');
        Route::get('contact/name', [AjaxContactController::class, 'name'])->name('contact.search.name');
    });
});

Route::group([
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::get('user/get-lecturers', [AjaxUserController::class, 'lecturers'])->name('user.search.lecturers');

        Route::delete('course/destroy/{course}', [AjaxCourseController::class, 'destroy'])->name('course.destroy');

        Route::delete('lesson/destroy/{lesson}', [AjaxLessonController::class, 'destroy'])->name('lesson.destroy');

        Route::delete('contact/destroy/{contact}', [AjaxContactController::class, 'destroy'])->name('contact.destroy');
    });
});

