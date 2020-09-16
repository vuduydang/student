<?php

namespace App\Repositories\Mails;

use App\Repositories\EloquentRepository;

class MailRepository extends EloquentRepository implements MailRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getModel()
    {
        return Result::class;
    }
}
