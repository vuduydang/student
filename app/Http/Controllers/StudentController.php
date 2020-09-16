<?php
namespace App\Http\Controllers;

use App\Http\Requests\Students\StudentCreateRequest;
use App\Http\Requests\Students\StudentUpdateRequest;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Results\ResultRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller{
    protected $studentRepository;
    protected $courseRepository;
    protected $userRepository;
    protected $subjectRepository;
    protected $resultRepository;

    public function __construct(UserRepository $user, StudentRepository $student, CourseRepository $course, SubjectRepository $subject, ResultRepository $result)
    {
        $this->userRepository = $user;
        $this->studentRepository = $student;
        $this->courseRepository = $course;
        $this->subjectRepository = $subject;
        $this->resultRepository = $result;
    }

    /**
     * Get students
     */
    public function index(Request $request)
    {
        $students = $this->studentRepository->filter($request);
        return view("students.list", compact('students'), compact('request'));
    }


    /**
     * view create student
     */
    public function create()
    {
        $courses = $this->courseRepository->getAll();
        return view('students.add', compact('courses'));
    }

    /**
     * @param StudentCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentCreateRequest $request)
    {
        $data = $request->all();
        $data['avatar'] = $this->studentRepository->uploaderImage('create', $request);
        //add user , get id user
        $data['user_id'] = $this->userRepository->insertGetId($data);
        //add student
        $this->studentRepository->create($data);
        return redirect()->route('students.index')->with('success', 'Add Success Student');
    }

    /**
     * @param $id
     */
    public function edit($id){
        $result['courses'] = $this->courseRepository->getAll();
        $result['student'] = $this->studentRepository->find($id);
        return view('students.update', $result);
    }

    public function show($request)
    {
        $student = $this->studentRepository->getProfile(Auth::user());
        return view('students.info', compact('student'));
    }

    /**
     * update student
     * */
    public function update(StudentUpdateRequest $request, $id)
    {
        $data = $request->all();
        //check file
        if ($request->hasFile('avatar'))
        {
            $data['avatar'] = $this->studentRepository->uploaderImage('update', $request);
        }
        //update user
        $this->userRepository->update($data['user_id'], $data);
        //update student
        $this->studentRepository->update($id, $data);
        //return
        return redirect()->route('students.index')->with('success', 'Update Success Student');
    }

    /**
     * @param $id
     */
    public function subject($id)
    {
        $student = $this->studentRepository->find($id);
        if (!$student->course) {
            return redirect()->route('students.edit',$student)->with('error', 'Ngành học của sinh viên không tồn tại.');
        }
        $subjects =  $student->subjects;
        return view('students.subject', compact('student','subjects'));
    }

    public function dataFaker(Faker $faker)
    {
        $limit = 500;
        for ($i=0; $i<$limit; $i++)
        {
            $data = [
                'name' => $faker->name,
                'birthday' =>$faker->date('Y-m-d','now'),
                'phone' => '0'.random_int(300000000,999999999),
                'email' => $faker->unique()->email,
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                'gender' => random_int(0,1),
                'course_id' => 1,
                'address' => $faker->address,
                'avg_score' => 0

            ];
            $data['avatar'] = 'null.png';
            //add user , get id user
            $data['user_id'] = $this->userRepository->insertGetId($data);
            //add student
            $this->studentRepository->create($data);
        }
        return redirect()->route('students.index');

    }

}
