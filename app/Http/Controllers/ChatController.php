<?php

namespace App\Http\Controllers;

use App\Events\PusherEvent;
use App\Repositories\Messages\MessageRepository;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    protected $studentRepository;
    protected $messageRepository;
    public function __construct(StudentRepository $student, MessageRepository $message)
    {
        $this->studentRepository = $student;
        $this->messageRepository = $message;
    }

    public function index()
    {
        return view('chat.index');
    }

    public function admin ()
    {
        return view('chat.admin');
    }

    public function pusher (Request $request)
    {
        $profile= $this->studentRepository->find($request->get('student'));
        $data['id'] = $profile->user_id;
        $data['avatar'] = $profile->avatar;
        $data['token'] = $request->get('_token');
        $data['message'] = $request->get('message');
        $data['timeline'] = date('H:i');

        try {
            $options = array(
                'cluster' => 'ap1',
                'encrypted' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('Chat', 'send-message', $data);
        } catch (\Exception $e) {
            return response('False');
        }
        $this->messageRepository->create([
            'student_id' => Auth::id(),
            'reply_for' => $request->student,
            'message' => $request->message,
        ]);
        return response($this->studentRepository->getProfile(Auth::user()));
    }

}
