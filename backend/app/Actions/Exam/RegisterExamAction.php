<?php
namespace App\Actions\Exam;

use App\DTOs\ExamDto;
use App\Repositories\Contracts\ExamRepositoryInterface;

class RegisterExamAction
{
    public function __construct(
        private ExamRepositoryInterface $repo
    ) {}

    public function execute(ExamDto $dto)
    {
        return $this->repo->create([
            'name'       => $dto->name,
            'laterality' => $dto->laterality,
            'comment'    => $dto->comment,
            'group'      => $dto->group,
        ]);
    }
}
