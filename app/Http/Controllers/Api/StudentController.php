<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Results\ResultCreateRequest;
use App\Http\Requests\Students\StudentCreateRequest;
use App\Http\Requests\Students\StudentUpdateRequest;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Results\ResultRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function update(Request $request, $id)
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
        return response()->json('Ok',200);
    }

    /**
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        $student = $this->studentRepository->find($id);
        $this->studentRepository->delete($id);
        $this->userRepository->delete($student->user_id);
        File::delete('./images/avatars/'.$student->avatar);
        return "OK";
    }
}
