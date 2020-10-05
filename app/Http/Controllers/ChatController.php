<?php

namespace App\Http\Controllers;

use App\Repositories\ChatRooms\ChatRoomRepository;
use App\Repositories\Messages\MessageRepository;
use App\Repositories\Students\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    protected $studentRepository;
    protected $chatroomRepository;
    protected $messageRepository;
    public function __construct(StudentRepository $student,ChatRoomRepository $chatRoom,MessageRepository $message)
    {
        $this->studentRepository = $student;
        $this->chatroomRepository = $chatRoom;
        $this->messageRepository = $message;
    }

    public function index()
    {
        $rooms = $this->chatroomRepository->getAll();
        $messages = $this->messageRepository->getAll();
        return view('chat.index', compact('rooms', 'messages'));
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
        $sender = $this->studentRepository->getProfile(Auth::user());
        $data['id'] = Auth::id();
        $data['avatar'] = $sender->avatar;
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
            //insert to DB
            $this->messageRepository->create([
                'chatroom_id' => $request->get('room_id'),
                'user_id' => Auth::id(),
                'message' => $request->get('message'),
            ]);
        } catch (\Exception $e) {
            return response('False');
        }
        return response($sender);
    }

}
