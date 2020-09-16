<?php
namespace App\Repositories\Users;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUser($social,$provider);
    public function changePass(array $data);
}
