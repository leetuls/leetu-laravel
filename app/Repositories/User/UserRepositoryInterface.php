<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * get user by id
     */
    public function getUserById($userId);
}
