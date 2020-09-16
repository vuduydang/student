<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Subjects\SubjectRepository;

class CourseController extends Controller
{
    protected $courseRepository;
    protected $subjectRepository;
    public function __construct(CourseRepository $course, SubjectRepository $subject)
    {
        $this->courseRepository = $course;
        $this->subjectRepository = $subject;
    }

    //delete courses
    public function destroy($id)
    {
        $this->subjectRepository->delSubjectInCourse($id);
        $this->courseRepository->delete($id);
        return 'OK';
    }

}
