<?php

namespace App\Repositories\Messages;

use App\Repositories\RepositoryInterface;

interface MessageRepositoryInterface extends RepositoryInterface
{
    //return list message
    public function messages(int $student);
}
