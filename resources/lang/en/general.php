<?php

return [

    /*
    |--------------------------------------------------------------------------
    | General Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during general use for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'login' => [
        'title' => 'Login',
        'subtitle' => 'Log in to your account to continue.',
        'email' => 'Email / Phone Number',
        'password' => 'Password',
        'question' => "Not registerd ?",
        'or' => 'Or',
        'facebook' => 'Continue with Facebook',
        'google' => 'Continue with Google',
        'button' => [
            'submit' => 'Login',
            'create' => 'Create an account'
        ]
    ],
    'register' => [
        'title' => 'Sign Up',
        'subtitle' => 'Already have an account?',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'phone' => 'Phone Number',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'cb_text' => [
            'start' => 'I agree to the Marzbo’s',
            'terms' => 'Terms and Conditions',
            'between' => 'and',
            'policy' => 'Privacy Policy',
            'end' => '.'
        ],
        'button' => [
            'submit' => 'Sign Up'
        ],
        'text' => [
            'success' => 'Register successfully',
            'description_success' => 'Your account has been registered, you will be logged in automatically.'
        ]
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'menu_title' => 'Dashboard',
        'subtitle' => 'Here is a quote to inspire your day'
    ],
    'user' => [
        'title' => 'Users',
        'menu_title' => 'Users',
        'logout' => 'Sign Out',
        'name' => 'User Name'
    ],
    'category' => [
        'title' => 'Categories',
        'menu_title' => 'Categories',
        'table_index' => [
            'name' => 'Name'
        ]
    ],
    'post' => [
        'title' => 'Posts',
        'menu_title' => 'Posts',
        'table_index' => [
            'group_post' => 'Group Of Post'
        ],
        'status' => [
            POST_STT_UNPUBLISHED => [
                'name' => 'Un published'
            ],
            POST_STT_PUBLISHED => [
                'name' => 'Published'
            ],
        ],
        'write_content' => 'Write content'
    ],
    'schedule' => [
        'title' => 'Schedules',
        'menu_title' => 'Schedules',
        'status' => [
            SCHEDULE_STT_PENDING => [
                'name' => 'Pending'
            ],
            SCHEDULE_STT_SUCCESS => [
                'name' => 'Success'
            ],
            SCHEDULE_STT_ERROR => [
                'name' => 'Error'
            ]
        ]
    ],
    'chatgpt' => [
        'new_chat' => 'New chat',
        'enter_question' => 'Enter any question'
    ],
    'social_media' => [
        'title' => 'Social Media',
        'menu_title' => 'Social Media',
        'select' => 'Select social media',
        'select_sub' => 'Choose social media here'
    ],
    'social_media_credential' => [
        'title' => 'Social Media Credential',
        'menu_title' => 'Social Media Credential',
    ],
    'role' => [
        'title' => 'Roles',
        'menu_title' => 'Roles'
    ],
    'permission' => [
        'title' => 'Permissions',
        'menu_title' => 'Permissions'
    ],
    'tooltip' => [
        'delete' => 'Delete',
        'edit' => 'Edit'
    ],
    'button' => [
        'cancel' => 'Cancel',
        'close' => 'Close',
        'create' => 'Create',
        'delete' => 'Delete',
        'update' => 'Update',
        'save' => 'Save',
        'published' => 'Published',
        'not_published' => 'Not published',
        'prev' => 'Previous',
        'next' => 'Next',
        'finish' => 'Finish'
    ],
    'choose' => [
        'status' => 'Choose status'
    ],
    'common' => [
        'actions' => 'Actions',
        'box_preview' => 'Box Preview',
        'comment' => 'Comment',
        'content' => 'Content',
        'contact' => 'Contact',
        'contact_with_us' => 'Contact with us',
        'country' => 'Country',
        'created_at' => 'Created At',
        'disable' => 'Disable',
        'dismiss' => 'Dismiss',
        'email' => 'Email',
        'empty' => 'Empty',
        'empty_table_message' => 'No data available in table',
        'enable' => 'Enable',
        'first_name' => 'First name',
        'last_name' => 'Last name',
        'group' => 'Group',
        'group_select' => 'Choose the group',
        'loading' => 'Loading...',
        'link_social' => 'social',
        'name' => 'Name',
        'user_role' => 'User role',
        'password' => 'Password',
        'password_confirm' => 'Passwrod confirm',
        'permissions' => 'Permissions',
        'phone_number' => 'Phone number',
        'publish_date' => 'Publish date',
        'react' => 'React',
        'result' => 'Results',
        'roles' => 'Roles',
        'schedule_time' => 'Schedule time',
        'status' => 'Status',
        'showing_page' => 'Showing page :page of :pages',
        'search' => 'Search...',
        'setting' => 'Setting',
        'social_media' => 'Social Media',
        'sort_by' => 'Sort by',
        'statistic' => 'Statistics',
        'time' => 'Time',
        'view' => 'View',
    ],
    'sidebar' => [
        'user_management' => 'Manage User',
    ],
    'menu' => [
        'dashboard' => 'Dashboard',
        'user_management' => [
            'title' => 'Manage Users',
            'user' => 'Users',
            'role' => 'Roles',
            'permission' => 'Permissions',
        ],
        'category_management' => [
            'title' => 'Manage Categories',
            'category' => 'Categories',
        ],
        'post_management' => [
            'title' => 'Manage Posts',
            'post' => 'Posts',
        ],
        'schedule_management' => [
            'title' => 'Manage Schedules',
            'schedule' => 'Schedules',
        ],
        'social_media_management' => [
            'title' => 'Manage Social Media',
            'social_media' => 'Social Media',
        ],
        'social_media_credential_management' => [
            'title' => 'Manage Social Media Credential',
            'social_media_credential' => 'Social Media Credential',
        ],
    ],
];
