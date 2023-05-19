<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the User Model
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all user models with roles (Eager Loading)
     */
    public function allWithRoles();

    /*
     * register account user customer
     */
    public function registerCustomer($data);

    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

    /**
     * @inheritdoc
     */
    public function toggleStatus($model);

    /**
     * @return mixed
     */
    public function countTotalUsers();
}
