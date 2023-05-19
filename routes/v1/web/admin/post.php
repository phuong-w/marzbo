<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('post', PostController::class);

Route::get('post/{post}/stats', [PostController::class, 'stats'])->name('post.stats');
