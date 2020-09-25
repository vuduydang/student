<?php

namespace App\Repositories\Results;

use App\Models\Result;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class ResultRepository extends EloquentRepository implements ResultRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getModel()
    {
        return Result::class;
    }

    /**
     * @param $student
     * @return ResultRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getResultStudent(int $student)
    {
        return $this->getAll()->where('student_id','=',$student);
    }

    public function updateOrCreate(array $where, array $value)
    {
        return $this->_model->query()->updateOrCreate($where,$value);
    }

    public function deleteOnStudent(int $student)
    {
        return $this->_model->query()->where('student_id',$student)->delete();
    }
    public function deleteOnSubject(int $subject)
    {
        return $this->_model->query()->where('subject_id',$subject)->delete();
    }

    public function avgScore(int $student)
    {
        $result = $this->_model->query()->where('student_id','=',$student)->avg('score');
        if ($result) {
            return $result;
        }
        return 0;
    }


}
