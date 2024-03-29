<?php

namespace App\Http\ViewComposers;

use App\Acl\Acl;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SidebarComposer
{
  /**
   * 'active' should check current routes (put in child and parent Route::is array)
   * 'show' should be used to check the permission to view the menu item
   * 'child' if menu have no child, leave it empty, don't delete it.
   */
  protected $menuItems;

  /**
   * Create a new sidebar composer.
   *
   * @return void
   */
  public function __construct()
  {
    $this->menuItems = [
      [
        'title' => __('general.menu.dashboard'),
        'url' => route('admin.dashboard'),
        'icon' => 'home',
        'active' => Route::is(['admin.dashboard']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_VIEW_MENU_DASHBOARD]),
        'child' => []
      ],
      [
        'title' => __('general.menu.user_management.title'),
        'url' => '',
        'icon' => 'users',
        'active' => Route::is(['admin.user.*', 'admin.role.*']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_USER_LIST, Acl::PERMISSION_VIEW_MENU_ROLE_PERMISSION]),
        'child' => [
          [
            'title' => __('general.menu.user_management.user'),
            'url' => route('admin.user.index'),
            'active' => Route::is('admin.user.*'),
            'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_USER_LIST]),
          ],
          [
            'title' => __('general.menu.user_management.role'),
            'url' => route('admin.role.index'),
            'active' => Route::is('admin.role.*'),
            'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_VIEW_MENU_ROLE_PERMISSION]),
          ]
        ],
      ],
      [
        'title' => __('general.menu.category_management.title'),
        'url' => route('admin.category.index'),
        'icon' => 'credit-card',
        'active' => Route::is(['admin.category.*']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_CATEGORY_LIST]),
        'child' => []
      ],
      [
        'title' => __('general.menu.post_management.title'),
        'url' => route('admin.post.index'),
        'icon' => 'credit-card',
        'active' => Route::is(['admin.post.*']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_POST_LIST]),
        'child' => []
      ],
      [
        'title' => __('general.menu.schedule_management.title'),
        'url' => route('admin.schedule.index'),
        'icon' => 'credit-card',
        'active' => Route::is(['admin.schedule.*']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_SCHEDULE_LIST]),
        'child' => []
      ],
      [
        'title' => __('general.menu.social_media_management.title'),
        'url' => route('admin.social_media.index'),
        'icon' => 'credit-card',
        'active' => Route::is(['admin.social_media.*']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_SOCIAL_MEDIA_LIST]),
        'child' => []
      ],
      [
        'title' => __('general.menu.social_media_credential_management.title'),
        'url' => route('admin.social_media_credential.index'),
        'icon' => 'credit-card',
        'active' => Route::is(['admin.social_media_credential.*']),
        'show' => auth()->user()->hasAnyPermission([Acl::PERMISSION_SOCIAL_MEDIA_CREDENTIAL_LIST]),
        'child' => []
      ],
    ];
  }

  /**
   * Bind data to the view.
   *
   * @param  \Illuminate\View\View  $view
   * @return void
   */
  public function compose(View $view)
  {
    $view->with('menuItems', $this->menuItems);
  }
}
