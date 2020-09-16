<?php
namespace App\Repositories\Courses;

use App\Repositories\Courses\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\EloquentRepository;

class CourseRepository extends EloquentRepository implements CourseRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function getModel()
    {
        return \App\Models\Course::class;
    }
}
