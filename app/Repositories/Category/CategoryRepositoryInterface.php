<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the User Model
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

    /*
    * Toggle status of the current resource
    *
    * @param $model
    */
    public function toggleStatus($model);
}
