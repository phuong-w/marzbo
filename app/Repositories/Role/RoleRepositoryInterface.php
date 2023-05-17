<?php

namespace App\Repositories\Role;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the Role Model
 */
interface RoleRepositoryInterface extends RepositoryInterface
{

  /**
   * Return all roles with loaded permissions
   *
   * @return collection
   */
  public function allRolesWithPermissions();

  /**
   * Filter the request from the performance
   *
   * @param array $searchParams
   * @return LengthAwarePaginator
   */
  public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;
}
