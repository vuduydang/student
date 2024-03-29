<?php

namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function getProfile(object $user);

    public function uploaderImage($action , object $request);

    public function filter(array $value);

}
