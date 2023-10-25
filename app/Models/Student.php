<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'address',
        'date_of_birth',
        'gender',
        'point_id',
        'student_phone',
        'updated_at'
    ];

    public function getStudentData()
    {
        $selectColection = DB::table('students')
            ->select(DB::raw(
                'students.name,
                students.id,
                students.student_id,
                students.date_of_birth,
                students.gender,
                student_classes.class_name,
                students.address, students.student_phone,
                student_classes.id as class_auto_id'
            ))
            ->join('student_classes', 'students.student_id', '=', 'student_classes.student_id');
        return $selectColection->paginate(6);
    }

    public function getSearchResult($condition)
    {
        $selectColection = $this->_getSqlCollection($condition);
        return $selectColection->paginate(6);
    }

    public function getDataExport($condition)
    {
        $selectColection = $this->_getSqlCollection($condition);
        return $selectColection->get();
    }

    public function getCountStudents()
    {
        $selectColection = DB::table('students')
            ->select(DB::raw(
                'count(1) as count_student'
            ))
            ->join('student_classes', 'students.student_id', '=', 'student_classes.student_id');
        return $selectColection->get();
    }

    private function _getSqlCollection($condition)
    {
        $selectColection = DB::table('students')
            ->select(DB::raw(
                'students.name,
                students.id,
            students.student_id,
            students.date_of_birth,
            students.gender,
            student_classes.class_name,
            students.address, students.student_phone,
            student_classes.id as class_auto_id'
            ))
            ->join('student_classes', 'students.student_id', '=', 'student_classes.student_id');


        if (isset($condition['auto_id'])) {
            $selectColection->where('students.id', '=', $condition['auto_id']);
        }

        if (isset($condition['student_id'])) {
            $selectColection->where('students.student_id', 'like', '%' . $condition['student_id'] . '%');
        }

        if (isset($condition['name'])) {
            $selectColection->where('students.name', 'like', '%' . $condition['name'] . '%');
        }

        if (isset($condition['date_of_birth'])) {
            $selectColection->where('students.date_of_birth', '=', $condition['date_of_birth']);
        }

        if (isset($condition['class_name'])) {
            $selectColection->where('student_classes.class_name', 'like', '%' . $condition['class_name'] . '%');
        }
        
        if (isset($condition['gender'])) {
            $selectColection->where('students.gender', 'like', '%' . $condition['gender'] . '%');
        }

        return $selectColection;
    }

    public function getStudentById($studentId)
    {
        return DB::table('students')->where('students.student_id', '=', $studentId)->exists();
    }

    public function findStudentByAutoId($id)
    {
        $selectColection = $this->_getSqlCollection(['auto_id' => $id]);
        return $selectColection->first();
    }
}
