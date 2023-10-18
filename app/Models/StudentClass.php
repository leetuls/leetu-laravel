<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'class_name',
        'teacher_id',
        'student_id'
    ];

    public function getClassStudentData($condition)
    {
        return DB::table('student_classes')->where('student_classes.class_name', '=', $condition['class'])->get();
    }
}
