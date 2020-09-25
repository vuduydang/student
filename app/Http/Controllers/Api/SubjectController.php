<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\SubjectCreateRequest;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Results\ResultRepository;
use App\Repositories\Subjects\SubjectRepository;

class SubjectController extends Controller
{
    protected $resultRepository;
    protected $subjectRepository;
    protected $courseRepository;
    public function __construct(SubjectRepository $subject, CourseRepository $course, ResultRepository $result)
    {
        $this->resultRepository = $result;
        $this->subjectRepository = $subject;
        $this->courseRepository = $course;
    }

    public function store(SubjectCreateRequest $request)
    {
        $data['course_id'] = $request->get('course_id');
        $data['name'] = $request->get('name');
        $this->subjectRepository->create($data);
        return response()->json(['OK']);
    }
    public function show($id)
    {
        $subjects = $this->subjectRepository->getSubjectInCourse($id);
        return response()->json(['data' => $subjects,"status" => 200]);
    }

    public function destroy($id)
    {
        $this->subjectRepository->delete($id);
        $this->resultRepository->deleteOnSubject($id);
        return response()->json(['OK']);
    }



}
