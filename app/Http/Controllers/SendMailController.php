<?php
namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Mail\Mailler;
use App\Repositories\Results\ResultRepository;
use App\Repositories\Students\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    protected $resultRepository;
    protected $studentRepository;
    public function __construct(StudentRepository $student)
    {
        $this->studentRepository = $student;
    }

    public function index()
    {
        return view('sendMail.index');
    }

    public function store(Request $request)
    {
        $this->studentRepository->sendMail($request);
//        //nội dung mail
//        $mail = new Mailler($request->all());
//        //chuyển thời gian về giây.
//        $time = $request->get('time') * 60 * 60;
//        //cách 1 (không delay)
//        Mail::to($request->get('email'))->queue($mail);
//        //cách 2 (có delay)
//        dispatch(new SendMail($request->all()))->delay(Carbon::now()->addSeconds(0));
        return redirect()->route('email.index');
    }
}
