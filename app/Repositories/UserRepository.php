<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\User;

class UserRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return USer::class;
    }

    /**
     * get total user from DB
     */
    public function getTotalUsers()
    {
        return $this->_model::count();
    }
}
