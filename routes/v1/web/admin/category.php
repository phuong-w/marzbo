<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('category', CategoryController::class);
Route::put('category/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('category.toggle_status');
