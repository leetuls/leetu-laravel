<?php

namespace App\Exports;

use App\Repositories\StudentRepository;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentDataExport implements FromView
{

    /**
     * @var StudentRepository
     */
    protected $studentRepository;

    protected $condition;

    public function __construct(StudentRepository $studentRepository, $condition)
    {
        $this->studentRepository = $studentRepository;
        $this->condition = $condition;
    }

    public function view(): View
    {
        $sudentList = $this->studentRepository->getDataExport($this->condition);
        return view('students.student-export', compact('sudentList'))->with('i', 0);
    }
}
