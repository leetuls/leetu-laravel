<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Repositories\StudentClassRepository;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                    'teacher_id' => 0,
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

    public function updateStudent($dataUpdate)
    {
        DB::beginTransaction();
        try {
            $studentClassRepository = new StudentClassRepository();
            $classStudentData = $studentClassRepository->getClassStudentData(['class' => $dataUpdate['class_name']]);
            $autoIdStudent = $dataUpdate['auto_id'];
            $now = Carbon::now()->timestamp;
            $studentData = $this->find($autoIdStudent);
            if (!empty($studentData->id)) {
                $studentUpdateAt = strtotime(
                    Carbon::createFromFormat('Y-m-d H:i:s', $studentData->updated_at, 'UTC')
                );
                if ($now < $studentUpdateAt) {
                    return 'exclusive';
                }
                $studentDataObj = [
                    'student_id' => $dataUpdate['student']['student_id'],
                    'name' => $dataUpdate['student']['name'],
                    'address' => $dataUpdate['student']['address'],
                    'date_of_birth' => $dataUpdate['student']['date_of_birth'],
                    'gender' => $dataUpdate['student']['gender'],
                    'point_id' => $studentData->point_id,
                    'created_at' => $studentData->created_at,
                    'student_phone' => $dataUpdate['student']['student_phone']
                ];
            }
            $classDataObj = [
                'class_id' => 'C00' . rand(),
                'class_name' => $dataUpdate['class_name'],
                'teacher_id' => 1,
                'student_id' => $dataUpdate['student']['student_id']
            ];
            if (!empty($classStudentData[0])) {
                $classData = $classStudentData[0];
                $studentData['class_id'] = $classData->class_id;
                $classDataObj['class_id'] = $classData->class_id;
            } else {
                $studentData['class_id'] = $classDataObj['class_id'];
            }
            $this->update($autoIdStudent, $studentDataObj);
            $studentClassRepository->update($dataUpdate['class_auto_id'], $classDataObj);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function studentDelete($dataRemove)
    {
        DB::beginTransaction();
        try {
            $studentClassRepository = new StudentClassRepository();
            $this->delete($dataRemove['auto_id']);
            $studentClassRepository->delete($dataRemove['class_auto_id']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }
    }
}
