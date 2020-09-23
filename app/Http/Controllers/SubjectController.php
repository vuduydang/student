<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\SubjectCreateRequest;
use App\Http\Requests\Subjects\SubjectUpdateRequest;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    protected $subjectRepository;
    protected $courseRepository;
    public function __construct(SubjectRepository $subject, CourseRepository $course, StudentRepository $student)
    {
        $this->subjectRepository = $subject;
        $this->courseRepository = $course;
    }

    public function show($id)
    {
        $data['course']  = $this->courseRepository->find($id);
        $data['subjects'] = $this->subjectRepository->getSubjectInCourse($id);
        return view('subjects.list', $data);
    }


    public function update(SubjectUpdateRequest $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        return $this->subjectRepository->update($id, ['name'=>$name]);
    }

    public function destroy($id)
    {
        return $this->subjectRepository->delete($id);
    }

}
