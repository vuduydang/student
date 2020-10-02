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
//        $student = $this->studentRepository->getProfile(Auth::user());
//        $messages = $this->messageRepository->messages($student->id);
//        dd($messages);
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
        $sender = $this->studentRepository->getProfile(Auth::user());
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
            $this->messageRepository->create([
                'sender' => $sender->id,
                'receiver' => $request->get('student'),
                'message' => $request->get('message'),
            ]);
        } catch (\Exception $e) {
            return response('False');
        }
        return response($sender);
    }

}
