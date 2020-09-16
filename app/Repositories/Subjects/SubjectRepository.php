<?php

namespace App\Repositories\Subjects;

use App\Repositories\Subjects\SubjectRepositoryInterface;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class SubjectRepository extends EloquentRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    /**
     * @param $courseId
     * @return SubjectRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSubjectInCourse($courseId)
    {
        return $this->getAll()->where('course_id','=',$courseId);
    }

    /**
     * @param $id
     * @return int
     */
    public function delSubjectInCourse($id)
    {
        $result = DB::table('subjects')
            ->where('course_id','=',$id)
            ->delete();
        return $result;
    }


}
