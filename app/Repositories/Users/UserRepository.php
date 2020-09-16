<?php
namespace App\Repositories\Users;

use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\User::class;
    }

    /**
     * @param int $provider_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getUser($social,$provider)
    {
        $user = $this->_model->query()->where('email',$social->email)->first();
        if ($user) {
            $user = $this->update($user->id,[
                'provider' => $provider,
                'provider_id' => $social->id
            ]);
        } else {
            $user = $this->create([
                'name'     => $social->name,
                'email'    => $social->email,
                'provider' => $provider,
                'provider_id' => $social->id
            ]);
        }
        return $user;
    }

    public function changePass(array $data)
    {
        $password = Auth::user()->getAuthPassword();
        if (Hash::check($data['password'], $password)) {
            $newPassword = Hash::make($data['newPassword']);
            $this->update(Auth::id(),['password'=>$newPassword]);
            return true;
        }
        return false;
    }
}
