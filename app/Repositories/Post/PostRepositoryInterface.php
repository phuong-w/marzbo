<?php

namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the User Model
 */
interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

    /**
     * @return mixed
     */
    public function getStasOfLastTwelveMonths();
}
