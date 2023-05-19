<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::put('user/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('user.toggle_status');
    Route::resource('user', UserController::class);

    Route::controller(UserController::class)
        ->group(function () {
            Route::get('setting', 'setting')->name('setting');
        });
});
