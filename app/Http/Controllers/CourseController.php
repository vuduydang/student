<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Courses\CourseCreateRequest;
use App\Http\Requests\Courses\CourseUpdateRequest;
use App\Repositories\Courses\CourseRepository;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    protected $courseRepository;
    protected $subjectRepository;
    public function __construct(CourseRepository $course,  SubjectRepository $subject)
    {
        $this->courseRepository = $course;
        $this->subjectRepository = $subject;
    }

    public function index()
    {
        $courses = $this->courseRepository->getAll();
        return view('courses.list',compact('courses'));
    }

    /**
     * return views add
     */
    public function create()
    {
        return view('courses.add');
    }

    public function store(CourseCreateRequest $request)
    {
        $data = $request->all();
        $this->courseRepository->create($data);
        return redirect()->route('courses.index')->with('success','Add Success Course');
    }

    //update courses
    public function update(CourseUpdateRequest $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');

        return $this->courseRepository->update($id, [
            'name' => $name
        ]);
    }


}
