<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = "results";

    protected $fillable = [
        'id', 'student_id', 'subject_id', 'score'
    ];

}
