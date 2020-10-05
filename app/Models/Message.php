<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";

    protected $fillable = [
        'id', 'chatroom_id','user_id','message'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'user_id','user_id');
    }
}
