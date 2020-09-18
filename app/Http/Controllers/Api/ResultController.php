<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Results\ResultCreateRequest;
use App\Repositories\Results\ResultRepository;
use App\Repositories\Students\StudentRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $resultRepository;
    protected $studentRepository;
    public function __construct(ResultRepository $result, StudentRepository $student)
    {
        $this->resultRepository = $result;
        $this->studentRepository = $student;
    }

    public function destroy($id)
    {
        //delete student
        $this->resultRepository->delete($id);
        return response()->json(["OK"]);
    }

}
