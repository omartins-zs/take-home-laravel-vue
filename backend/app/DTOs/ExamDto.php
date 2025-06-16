<?php
namespace App\DTOs;

use App\Http\Requests\RegisterExamRequest;

final class ExamDto
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $laterality,
        public readonly string $comment,
        public readonly string $group,
    ) {}

    public static function fromRequest(RegisterExamRequest $req): self
    {
        return new self(
            name: $req->input('name'),
            laterality: $req->input('laterality'),
            comment: $req->input('comment'),
            group: $req->input('group'),
        );
    }
}

