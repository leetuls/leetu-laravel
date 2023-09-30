<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StudentRepository;

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
        return view('students.student', compact('sudentList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $returnHTML = view('students.add-new')->render();
            return response(['html' => $returnHTML]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->studentRepository->create($request->all());
        return redirect()->route('students.index');
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
    public function edit(string $id)
    {
        //
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
        $sudentList = $this->studentRepository->getStudentData();
        $studentTotal = count($sudentList);
        return view('home', compact('studentTotal'));
    }

    public function getSearchResult(Request $request)
    {
        if ($request->ajax()) {
            $condition = [
                'name' => $request->get('name'),
                'date_of_birth' => $request->get('dateOfBirth'),
                'class_name' => $request->get('studentClass')
            ];
            $sudentList = $this->studentRepository->getSearchResult($condition);
            $returnHTML = view('students.search', compact('sudentList'))->render();
            return response(['html' => $returnHTML]);
        }
    }
}
