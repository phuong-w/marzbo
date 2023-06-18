<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Error Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during error for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'message' => 'There is an error: :message',
    'exception' => 'There is an exception error, please try again later!',

    'user' => [
        'register' => 'Register account for fail.',
        'login' => 'Logged in fail.'
    ],
    'account' => [
        'store' => 'Create account fail.',
        'delete' => 'Delete account fail.'
    ],
    'post' => [
        'store' => 'Create post fail.',
        'update' => 'Update post fail.',
        'delete' => 'Delete post fail.',
        'stats' => 'Sync stats of this post fail.',
        'published' => 'This post not published.'
    ],
    'social_media' => [
        'require_select' => 'Please select at least one social media.'
    ],
];
