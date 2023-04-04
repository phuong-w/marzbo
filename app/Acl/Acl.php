<?php

/**
 * File Acl.php
 *
 * @author Phuong Nguyen
 * @package Marzbo
 * @version 1.0
 */

namespace App\Acl;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class Acl
{
    const ROLE_SUPER_ADMIN          = 'super admin';
    const ROLE_ADMIN                = 'admin';
    const ROLE_STAFF                = 'staff';
    const ROLE_SUPPLIER             = 'partner';
    const ROLE_CUSTOMER             = 'customer';

    const PERMISSION_ASSIGNEE     = 'assignee';
    const PERMISSION_VIEW_MENU_PERMISSION       = 'view menu permission';
    const PERMISSION_VIEW_MENU_DASHBOARD        = 'view menu dashboard';
    const PERMISSION_VIEW_MENU_ADMIN            = 'view menu admin';
    const PERMISSION_VIEW_MENU_STAFF            = 'view menu partner';
    const PERMISSION_VIEW_MENU_ROLE_PERMISSION  = 'view menu role-permission';
    const PERMISSION_VIEW_MENU_ACCOUNT          = 'view menu account';

    const PERMISSION_PERMISSION_MANAGE      = 'manage permission';

    const PERMISSION_USER_MANAGE            = 'manage user';
    const PERMISSION_USER_LIST              = 'user list';
    const PERMISSION_USER_ADD               = 'user add';
    const PERMISSION_USER_EDIT              = 'user edit';
    const PERMISSION_USER_DELETE            = 'user delete';

    const PERMISSION_CUSTOMER_MANAGE        = 'manage customer';
    const PERMISSION_CUSTOMER_LIST          = 'customer list';
    const PERMISSION_CUSTOMER_ADD           = 'customer add';
    const PERMISSION_CUSTOMER_EDIT          = 'customer edit';
    const PERMISSION_CUSTOMER_DELETE        = 'customer delete';

    const PERMISSION_CATEGORY_MANAGE      = 'manage category';
    const PERMISSION_CATEGORY_LIST        = 'category list';
    const PERMISSION_CATEGORY_ADD         = 'category add';
    const PERMISSION_CATEGORY_EDIT        = 'category edit';
    const PERMISSION_CATEGORY_DELETE      = 'category delete';

    const PERMISSION_POST_MANAGE      = 'manage post';
    const PERMISSION_POST_LIST        = 'post list';
    const PERMISSION_POST_ADD         = 'post add';
    const PERMISSION_POST_EDIT        = 'post edit';
    const PERMISSION_POST_DELETE      = 'post delete';

    const PERMISSION_SCHEDULE_MANAGE      = 'manage schedule';
    const PERMISSION_SCHEDULE_LIST        = 'schedule list';
    const PERMISSION_SCHEDULE_ADD         = 'schedule add';
    const PERMISSION_SCHEDULE_EDIT        = 'schedule edit';
    const PERMISSION_SCHEDULE_DELETE      = 'schedule delete';

    const PERMISSION_SOCIAL_MEDIA_MANAGE      = 'manage social media';
    const PERMISSION_SOCIAL_MEDIA_LIST        = 'social media list';
    const PERMISSION_SOCIAL_MEDIA_ADD         = 'social media add';
    const PERMISSION_SOCIAL_MEDIA_EDIT        = 'social media edit';
    const PERMISSION_SOCIAL_MEDIA_DELETE      = 'social media delete';

    const PERMISSION_SOCIAL_MEDIA_CREDENTIAL_MANAGE      = 'manage social media credential';
    const PERMISSION_SOCIAL_MEDIA_CREDENTIAL_LIST        = 'social media credential list';
    const PERMISSION_SOCIAL_MEDIA_CREDENTIAL_ADD         = 'social media credential add';
    const PERMISSION_SOCIAL_MEDIA_CREDENTIAL_EDIT        = 'social media credential edit';
    const PERMISSION_SOCIAL_MEDIA_CREDENTIAL_DELETE      = 'social media credential delete';

    const PERMISSION_CHATGPT_MANAGE      = 'manage chat gpt';

    /**
     * @param array $exclusives Exclude some permissions from the list
     * @return array
     */
    public static function permissions(array $exclusives = []): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) use ($exclusives) {
                return !in_array($value, $exclusives) && Str::startsWith($key, 'PERMISSION_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function menuPermissions(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'PERMISSION_VIEW_MENU_');
            });

            return array_values($permissions);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    /**
     * @return array
     */
    public static function roles(): array
    {
        try {
            $class = new \ReflectionClass(__CLASS__);
            $constants = $class->getConstants();
            $roles =  Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            return array_values($roles);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }
}
