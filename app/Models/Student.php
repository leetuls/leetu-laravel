<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'address',
        'date_of_birth',
        'gender',
        'point_id'
    ];

    public function getStudentData()
    {
        $selectColection = DB::table('students')
            ->select(DB::raw(
                'students.name,
                students.id,
                students.date_of_birth,
                students.gender,
                student_classes.class_name,
                students.address'
            ))
            ->join('student_classes', 'students.student_id', '=', 'student_classes.student_id');
            return $selectColection->paginate(10);
    }

    public function getSearchResult($condition)
    {
        $selectColection = DB::table('students')
            ->select(DB::raw(
                'students.name,
                students.id,
                students.date_of_birth,
                students.gender,
                student_classes.class_name,
                students.address'
            ))
            ->join('student_classes', 'students.student_id', '=', 'student_classes.student_id');

        if (isset($condition['name'])) {
            $selectColection->where('students.name', 'like', '%' . $condition['name'] . '%');
        }

        if (isset($condition['date_of_birth'])) {
            $selectColection->where('students.date_of_birth', 'like', '%' . $condition['date_of_birth'] . '%');
        }

        if (isset($condition['class_name'])) {
            $selectColection->where('student_classes.class_name', 'like', '%' . $condition['class_name'] . '%');
        }

        return $selectColection->paginate(10);
    }
}
