<?php

namespace App\Repositories\Chatgpt;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the User Model
 */
interface ChatgptRepositoryInterface extends RepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function updateOrCreate($data, $model);
}
