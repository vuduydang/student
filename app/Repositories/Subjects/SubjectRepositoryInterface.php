<?php

namespace App\Repositories\Subjects;

use App\Repositories\RepositoryInterface;
interface SubjectRepositoryInterface extends RepositoryInterface
{
    //Lấy danh sách môn học theo ngành học
    public function getSubjectInCourse($courseId);
    //Xóa môn học theo ngành học
    public function delSubjectInCourse($id);
}
