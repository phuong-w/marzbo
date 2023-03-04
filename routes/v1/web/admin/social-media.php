<?php

use App\Http\Controllers\Admin\SocialMediaController;
use Illuminate\Support\Facades\Route;

Route::resource('social-media', SocialMediaController::class)->names('social_media');
