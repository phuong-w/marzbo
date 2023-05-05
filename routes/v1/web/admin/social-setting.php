<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('auth/{social}', [UserController::class, 'redirectToProvider'])->name('social.connect');
Route::get('auth/{social}/callback', [UserController::class, 'handleProviderCallback'])->name('social.callback');
