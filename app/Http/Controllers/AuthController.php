<?php

namespace App\Http\Controllers;

use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    protected $repository;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login(Request $request){
        if ($request->isMethod('post')){
            $rule = [
                'email'=>'required',
                'password'=>'required|min:6'
            ];
            $mg = [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Password cần có ít nhất 6 kí tự'
            ];
            $validator = Validator::make($request->all(), $rule, $mg);

            if($validator->fails()){
                $data['error'] = $validator->errors();
            }else{
                //  login
                $dataLogin = [
                    'email' => $request->get('email'),
                    'password' => $request->get('password')
                ];

                if (Auth::attempt($dataLogin)) {
                    // login thanh cong
                    return redirect()->route('dash');
                } else {
                    exit('Sai thông tin đăng nhập');
                }

            }
        }
        return view('login');
    }

    public function register(Request $request){
        if ($request->isMethod('post')){
            $rule = [
                'name'=>'required',
                'email'=>'required|unique:users',
                'avatar'=>'required',
                'password'=>'required|min:6'
            ];
            $mg = [
                'name.required' => 'Bạn chưa nhập Name',
                'email.unique' => 'Email này đã tồn tại',
                'email.required' => 'Bạn chưa nhập Email',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Password cần có ít nhất 6 kí tự'
            ];
            $validator = Validator::make($request->all(), $rule, $mg);

            if($validator->fails()){
                $error = $validator->errors();
            }else{
                if($request->hasFile('avatar')){
                    $file = $request->file('avatar');
                    $folder = 'images/avatars';
                    $file->move($folder, $file->getClientOriginalName());
                    $avatar = $file->getClientOriginalName();
                }
                $data = [
                    'name' => $request->get('name'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                    'avatar' => $avatar,
                ];
                //create in table
                $this->repository->create($data);
                //return for dash
                return redirect(route('dash'));
            }
//            dd($error);
            return redirect()->route('register')->withErrors($error);
        }
        return view('auth.register');
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}
