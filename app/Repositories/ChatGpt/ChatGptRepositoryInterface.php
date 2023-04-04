<?php

namespace App\Repositories\ChatGpt;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the User Model
 */
interface ChatGptRepositoryInterface extends RepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function updateOrCreate($data, $model);
}
