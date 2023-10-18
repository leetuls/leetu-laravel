<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Repositories\StudentClassRepository;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

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

    /**
     * get count student infomation
     */
    public function getCountStudents()
    {
        return $this->_model->getCountStudents();
    }

    /**
     * get data export excel
     */
    public function getDataExport($condition)
    {
        return $this->_model->getDataExport($condition);
    }

    /**
     * insert student data and class data
     */
    public function createStudent($dataInsert)
    {
        DB::beginTransaction();
        try {
            $studentClassRepository = new StudentClassRepository();
            $classStudentData = $studentClassRepository->getClassStudentData(['class' => $dataInsert['class']]);
            $studentData = $dataInsert['student'];
            $studentData['point_id'] = 1;
            if (!empty($classStudentData[0])) {
                $classData = $classStudentData[0];
                $studentData['class_id'] = $classData->class_id;
                $classDataObj = [
                    'class_id' => $classData->class_id,
                    'class_name' => $classData->class_name,
                    'teacher_id' => 1,
                    'student_id' => $studentData['student_id']
                ];
            } else {
                $classDataObj = [
                    'class_id' => 'C00' . rand(),
                    'class_name' => $dataInsert['class'],
                    'teacher_id' => 0,
                    'student_id' => $studentData['student_id']
                ];
                $studentData['class_id'] = $classDataObj['class_id'];
            }
            $this->create($studentData);
            $studentClassRepository->create($classDataObj);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function checkStudentExist($studentId)
    {
        if ($this->_model->getStudentById($studentId)) {
            return true;
        }
        return false;
    }

    public function findStudentByAutoId($id)
    {
        return $this->_model->findStudentByAutoId($id);
    }
}
