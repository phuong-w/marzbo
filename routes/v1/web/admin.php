<?php

use App\Acl\Acl;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    include('admin/auth.php');

    Route::middleware(['auth.admin', 'role_or_permission:' . Acl::ROLE_SUPER_ADMIN . '|' . Acl::ROLE_ADMIN . '|' . Acl::ROLE_STAFF . '|' . Acl::ROLE_CUSTOMER . '|' . Acl::PERMISSION_VIEW_MENU_ADMIN])->group(function () {
        include('admin/dashboard.php');
        include('admin/user.php');
        include('admin/role.php');
        include('admin/category.php');
        include('admin/post.php');
        include('admin/schedule.php');
        include('admin/social-media.php');
        include('admin/social-media-credential.php');
    });
});
