<?php

namespace App\Http\Controllers;

use App\Repositories\StudentRepository;
use App\Repositories\UserRepository;

class DasboardController extends Controller
{
    /**
     * @var StudentRepository
     */
    protected StudentRepository $studentRepository;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    public function __construct(StudentRepository $studentRepository, UserRepository $userRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
    }


    public function getDataDasboard()
    {
        $sudentList = $this->studentRepository->getCountStudents();
        $studentTotal = $sudentList[0]->count_student;

        $usersTotal = $this->userRepository->getToTalUsers();

        return view('home', compact('studentTotal', 'usersTotal'));
    }
}
