<?php

namespace App\Repositories\SocialMediaCredential;

use App\Repositories\RepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * The repository interface for the User Model
 */
interface SocialMediaCredentialRepositoryInterface extends RepositoryInterface
{
    /**
     * Filter the request from the performance
     *
     * @param array $searchParams
     * @return LengthAwarePaginator
     */
    public function serverPaginationFilteringFor(array $searchParams): LengthAwarePaginator;

    public function updateOrCreate($userSocialConnected, $provider);
}
