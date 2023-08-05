<?php

use App\Http\Controllers\Ajax\AjaxProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HomepageController;
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
});

Route::group([
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
});

