<?php

use App\Http\Controllers\Admin\SocialMediaCredentialController;
use Illuminate\Support\Facades\Route;

Route::resource('social-media-credential', SocialMediaCredentialController::class)->names('social_media_credential');
