<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'store' => 'Create :resource successfully',
    'delete' => 'Delete :resource successfully',
    'update' => 'Edit :resource successfully',
    'changed_status' => 'Change status successfully',
    'confirm' => [
        'delete' => [
            'title' => 'Deleted!',
            'description' => "Your file has been deleted."
        ],
    ],

    'user' => [
        'register' => 'Register account for :user successfully',
        'login' => 'Logged in successfully'
    ],
    'email_subscribe' => [
        'store' => 'Email :email_subscribe successfully subscribe',
        'delete' => 'Delete :email_subscribe successfully',
        'update' => 'Edit :email_subscribe successfully',
    ],
    'payment_method' => [
        'store' => "Create payment method successfully",
        'delete' => "Delete payment method successfully",
        'update' => "Edit payment method :name successfully",
        'changed_status' => 'Change status successfully'
    ],
    'account' => [
        'store' => 'Create account successfully',
        'delete' => 'Delete account successfully'
    ]
];
