<?php

use App\Http\Controllers\Ajax\AjaxProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\User\HomepageController;
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
});

Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/verifyEmail', [AuthController::class, 'verifyEmail'])->name('verifyEmail');

    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::post('/verifyEmail', [AjaxProfileController::class, 'verifyEmail'])->name('verifyEmail');
    });
});
Route::get('/', [HomepageController::class, '__invoke'])->name('index');
Route::get('/pricing', [PricingController::class, '__invoke'])->name('pricing');
Route::get('/course', [CourseController::class, '__invoke'])->name('course');
Route::get('/contact', [ContactController::class, '__invoke'])->name('contact');
