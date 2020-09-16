<?php

namespace App\Http\Controllers;

use App\Repositories\Students\StudentRepository;
use App\Repositories\Users\UserRepository;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    protected $userRepository;
    protected $studentRepository;
    public function __construct(UserRepository $user, StudentRepository $student)
    {
        $this->userRepository = $user;
        $this->studentRepository = $student;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback($provider)
    {
        try {
            $social = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $user = $this->checkUser($social,$provider);
        auth()->login($user);
        return redirect()->to('/students/profile')->with('success', 'Check and Up date profile !');;
    }


    function checkUser($social,$provider)
    {
        $user = $this->userRepository->getUser($social,$provider);
        $this->studentRepository->getProfile($user);
        return $user;
    }
}
