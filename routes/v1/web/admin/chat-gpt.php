<?php

use App\Http\Controllers\Admin\ChatGptController;
use Illuminate\Support\Facades\Route;

Route::get('chat-gpt/{chatGpt:uuid?}', [ChatGptController::class, 'index'])->name('chat_gpt.index');
Route::get('chat-gpt/create/add-your-api-key', [ChatGptController::class, 'create'])->name('chat_gpt.create');
Route::post('chat-gpt/create/add-your-api-key', [ChatGptController::class, 'addApiKey'])->name('chat_gpt.add_api_key');

Route::middleware('verify_openai_key')->group(function () {
    Route::delete('chat-qpt/{chatGpt:uuid?}', [ChatGptController::class, 'destroy'])->name('chat_gpt.destroy');
    Route::post('chat-gpt/{chatGpt:uuid?}', [ChatGptController::class, 'store'])->name('chat_gpt.store');
});
