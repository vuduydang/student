<?php

namespace App\Models;

use http\Env\Response;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";

    protected $fillable = [
        'id','user_id','course_id','name','birthday','address','avatar','gender','phone','email','avg_score','status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function subjects()
    {
//        return $this->belongsTo(Subject::class,'course_id','course_id');
        $result = $this->hasMany(Subject::class,'course_id','course_id');
        if ($result) {
            return $result;
        }
        return false;
    }

    public function subjectResults()
    {
        $result = $this->belongsToMany(Subject::class, 'results')
            ->withPivot('id','score')
            ->withTimestamps();
        if ($result) {
            return $result;
        }
        return false;
    }


}
