<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = "messages";

    protected $fillable = [
        'id', 'sender','receiver','message'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'sender');
    }
}
