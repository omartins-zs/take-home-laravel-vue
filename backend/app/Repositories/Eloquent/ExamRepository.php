<?php

namespace App\Repositories\Eloquent;

use App\Models\Exam;
use App\Repositories\Contracts\ExamRepositoryInterface;

class ExamRepository implements ExamRepositoryInterface
{
    public function paginate(int $perPage = 15)
    {
        return Exam::paginate($perPage);
    }

    public function find(int $id): ?Exam
    {
        return Exam::find($id);
    }

    public function create(array $data): Exam
    {
        return Exam::create($data);
    }
}
