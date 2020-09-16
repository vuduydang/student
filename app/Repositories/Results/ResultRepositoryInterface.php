<?php

namespace App\Repositories\Results;

use App\Repositories\RepositoryInterface;

interface ResultRepositoryInterface extends RepositoryInterface
{
    //lấy danh sách điểm của sinh viên
    public function getResultStudent(int $student);

    //chỉnh sửa hoặc thêm dữ liệu vào bảng results
    public function updateOrCreate(array $where, array $value);

    //Tính điểm trung bình cho sinh viên
    public function avgScore(int $student);

    //Xóa nhiều điểm của sinh viên
    public function deleteOnStudent(int $student);
}
