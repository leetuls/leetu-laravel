<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\StudentClass;

class StudentClassRepository extends EloquentRepository
{
    /**
     * get model
     * @return StudentClass
     */
    public function getModel()
    {
        return StudentClass::class;
    }

    public function getClassStudentData($condition)
    {
        return $this->_model->getClassStudentData($condition);
    }
}
