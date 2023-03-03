<?php

namespace App\Repositories\SocialMedia;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the User Model
 */
interface SocialMediaRepositoryInterface extends RepositoryInterface
{
    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;
}
