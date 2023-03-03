<?php

if (!function_exists('checkPermission')) {

  /**
   * Check permission from current user
   *
   * @param string $permission
   * @return bool
   */
  function checkPermission($permission)
  {
    return auth()->user()->hasPermissionTo($permission);
  }
}

if (!function_exists('checkPermissions')) {

  /**
   * Check permissions from current user
   *
   * @param array $permissions
   * @return bool
   */
  function checkPermissions($permissions)
  {
    return auth()->user()->hasAnyPermission($permissions);
  }
}

if (!function_exists('checkOldArray')) {

    /**
     * Check old input name array from current user
     *
     * @param mixed $value
     * @param string $oldInputName
     * @param array $default
     * @return bool
     */
    function checkOldArray($value, $oldInputName, $default = null)
    {
        $array = old($oldInputName, $default);
        return $array && in_array($value, $array) ? 'selected' : '';
    }
}
