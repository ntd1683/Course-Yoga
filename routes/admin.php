<?php

use App\Http\Middleware\CheckAdminMiddleware;

Route::group([
    'middleware' => CheckAdminMiddleware::class,
], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

