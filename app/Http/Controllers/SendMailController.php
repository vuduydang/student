<?php
namespace App\Http\Controllers;

use App\Http\Requests\Mails\MailCreateRequest;
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

    public function store(MailCreateRequest $request)
    {
        $this->studentRepository->sendMail($request);
        return redirect()->route('email.index');
    }
}
