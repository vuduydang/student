<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subjects";

    protected $fillable = [
        'id','course_id', 'name'
    ];


    public function results()
    {
        return $this->belongsTo(Result::class);
    }
}
