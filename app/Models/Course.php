<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";

    protected $fillable = [
        'id', 'name'
    ];

//    public function subjects()
//    {
//        $result = $this->morphMany(Subject::class,'course');
//        if ($result) {
//            return $result;
//        }
//        return false;
//    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
//    public function result()
//    {
//        return $this->belongsTo(Result::class, 'course_id');
//    }

}
