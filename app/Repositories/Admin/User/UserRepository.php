<?php

namespace App\Repositories\Admin\User;

use App\Models\User;
use App\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected $model;

    /**
     * Create a new class instance.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserWithProfile(string $id): object
    {
        return $this->model::with(['profile'])->find($id);
    }
}
