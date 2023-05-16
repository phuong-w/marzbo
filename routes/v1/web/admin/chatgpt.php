<?php

use App\Http\Controllers\Admin\ChatgptController;
use Illuminate\Support\Facades\Route;

Route::get('chatgpt/{chatgpt:uuid?}', [ChatgptController::class, 'index'])->name('chatgpt.index');
Route::post('chatgpt/{chatgpt:uuid?}', [ChatgptController::class, 'store'])->name('chatgpt.store');
Route::delete('chatqpt/{chatgpt:uuid?}', [ChatgptController::class, 'destroy'])->name('chatgpt.destroy');
