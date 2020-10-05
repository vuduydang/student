<?php

namespace App\Repositories\Messages;

use App\Models\Message;
use App\Repositories\EloquentRepository;

class MessageRepository extends EloquentRepository implements MessageRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getModel()
    {
        return Message::class;
    }

    public function messages(int $student)
    {
        return $this->_model->query()
            ->where('receiver',$student)
            ->get()
            ->groupBy('sender');
    }
}
