<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StudentDataExport;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

    /**
     * @var StudentRepository
     */
    protected StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sudentList = $this->studentRepository->getStudentData();
        $studentTotal = $this->studentRepository->getCountStudents()[0]->count_student;
        return view('students.student', compact('sudentList', 'studentTotal'))->with('i', (request()->input('page', 1) - 1) * 6);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $returnHTML = view('students.add-new')->with('mode', 'new')->render();
            return response(['html' => $returnHTML]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataInsert = [
            'student' => [
                'student_id' => $request->get('student_id'),
                'name' => $request->get('name'),
                'date_of_birth' => $request->get('date_of_birth'),
                'gender' => $request->get('gender'),
                'address' => $request->get('address'),
                'student_phone' => $request->get('student_phone')
            ],
            'class' => $request->get('class_name')
        ];
        try {
            if (!$this->studentRepository->checkStudentExist($dataInsert['student']['student_id'])) {
                $this->studentRepository->createStudent($dataInsert);
                return redirect()->route('students.index')->with(
                    'success_message',
                    'Học sinh mã ' . $dataInsert['student']['student_id'] . ' đã được thêm thành công!'
                );
            } else {
                return redirect()->back()->with(
                    'error_message',
                    'Mã học sinh ' . $dataInsert['student']['student_id'] . ' đã tồn tại!'
                );
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $studentData = $this->studentRepository->findStudentByAutoId($request->get('auto_id'));
            $returnHTML = view('students.add-new', compact('studentData'))->with('mode', 'edit')->render();
            return response(['html' => $returnHTML]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getCountStudent()
    {
        $sudentList = $this->studentRepository->getCountStudents();
        $studentTotal = $sudentList[0]->count_student;
        return view('home', compact('studentTotal'));
    }

    public function getSearchResult(Request $request)
    {
        if ($request->ajax()) {
            $condition = [
                'student_id' => $request->get('student_id'),
                'name' => $request->get('name'),
                'date_of_birth' => $request->get('dateOfBirth'),
                'class_name' => $request->get('studentClass'),
                'page' => $request->get('page')
            ];
            $sudentList = $this->studentRepository->getSearchResult($condition);
            $returnHTML = view('students.search', compact('sudentList'))->with('i', ($condition['page'] - 1) * 6)->render();
            return response(['html' => $returnHTML]);
        }
    }

    public function exportExcel(Request $request)
    {
        if ($request->ajax()) {
            $condition = [
                'student_id' => $request->get('student_id'),
                'name' => $request->get('name'),
                'date_of_birth' => $request->get('dateOfBirth'),
                'class_name' => $request->get('studentClass'),
                'page' => $request->get('page')
            ];
            $studentExcelFile = Excel::raw(new StudentDataExport($this->studentRepository, $condition), \Maatwebsite\Excel\Excel::XLSX);
            $response = array(
                'name' => 'student_data.xlsx',
                'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($studentExcelFile),
            );
            return response()->json($response);
        }
    }

    public function exportPdf(Request $request)
    {
        if ($request->ajax()) {
            $condition = [
                'student_id' => $request->get('student_id'),
                'name' => $request->get('name'),
                'date_of_birth' => $request->get('dateOfBirth'),
                'class_name' => $request->get('studentClass'),
                'page' => $request->get('page')
            ];
            $sudentList = $this->studentRepository->getDataExport($condition);
            $i = 0;
            $pdf = PDF::loadView('students.student-export', compact('sudentList', 'i'));
            $pathPdf = public_path('//pdf/');
            if (!File::isDirectory($pathPdf)) {
                File::makeDirectory($pathPdf, 0777);
            }
            $fileName =  time() . '.' . 'pdf';
            $pdf->save(public_path('//pdf/') . $fileName);
            $pdf = public_path('//pdf/' . $fileName);
            return response()->download($pdf);
        }
    }
}
