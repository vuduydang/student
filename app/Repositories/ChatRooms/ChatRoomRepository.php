<?php
namespace App\Repositories\ChatRooms;

use App\Repositories\EloquentRepository;

class ChatRoomRepository extends EloquentRepository implements ChatRoomRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getModel()
    {
        return \App\Models\ChatRoom::class;
    }
}
