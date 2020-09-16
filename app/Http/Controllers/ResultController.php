<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Results\ResultCreateRequest;
use App\Repositories\Results\ResultRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Subjects\SubjectRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $resultRepository;
    protected $studentRepository;
    protected $subjectRepository;
    public function __construct(ResultRepository $result, StudentRepository $student, SubjectRepository $subject)
    {
        $this->resultRepository = $result;
        $this->studentRepository = $student;
        $this->subjectRepository = $subject;
    }

    public function update($student ,ResultCreateRequest $request)
    {
        $subject = $request->get('subject') ?? [];
        $score   = $request->get('score');
        $course  = $request->get('course');
//        $this->resultRepository->deleteOnStudent($student);
        for ($i=0; $i<count($subject); $i++)
        {
            $where['student_id'] = $student;
            $where['subject_id'] = $subject[$i];
            $value['score'] = $score[$i];
            $this->resultRepository->updateOrCreate($where, $value);
        }
        //Cập nhật điểm trung bình cho sinh viên
        $avgScore = $this->resultRepository->avgScore($student);
        $this->studentRepository->update($student, ['avg_score'=>$avgScore]);
        //Cập nhật trạng thái nếu sinh viên hoàn thành chương trình học
        $totalSubjects = $this->subjectRepository->getSubjectInCourse($course)->count();
        $totalResults = $this->resultRepository->getResultStudent($student)->count();
        if ($totalSubjects == $totalResults) {
            $this->studentRepository->update($student, ['status'=>'1']);
        } else {
            $this->studentRepository->update($student, ['status'=>'0']);
        }

        return redirect()->route('students.subject',['id'=>$student])->with('success','Cập nhật điểm thành công');
    }

}
