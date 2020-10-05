<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $table = "chatrooms";

    protected $fillable = [
        'name'
    ];

    public function messages()
    {
        $result = $this->hasMany(Message::class,'chatroom_id');
        if ($result) {
            return $result;
        }
        return false;
    }
}
