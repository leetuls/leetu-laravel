<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Student;

class StudentRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Student::class;
    }

    /**
     * get student infomation
     */
    public function getStudentData()
    {
        return $this->_model->getStudentData();
    }

    /**
     * get search infomation
     */
    public function getSearchResult($condition)
    {
        return $this->_model->getSearchResult($condition);
    }
}
