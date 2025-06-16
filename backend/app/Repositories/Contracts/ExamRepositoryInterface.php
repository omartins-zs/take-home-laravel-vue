<?php

namespace App\Repositories\Contracts;

interface ExamRepositoryInterface
{
    public function paginate(int $perPage = 15);
    public function find(int $id): ?\App\Models\Exam;
    public function create(array $data): \App\Models\Exam;
}
