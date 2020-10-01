<?php

namespace App\Http\Controllers;

use App\Events\PusherEvent;
use App\Repositories\Students\StudentRepository;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    protected $studentRepository;
    public function __construct(StudentRepository $student)
    {
        $this->studentRepository = $student;
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
        return response($this->studentRepository->getProfile(Auth::user()));
    }

}
