<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequestPassword;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;
    function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    public function changePassword(UserRequestPassword $request)
    {
        return $this->userRepository->changePass($request->all());
    }
}

