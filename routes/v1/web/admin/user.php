<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);

    Route::controller(UserController::class)
        ->group(function () {
           Route::get('setting', 'setting')->name('setting');
        });
});
