<?php

namespace App\Repositories\Admin\User;

interface UserRepositoryInterface
{
    public function getUserWithProfile(string $id): object;
}
