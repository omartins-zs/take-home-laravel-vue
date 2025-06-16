<?php
namespace App\DTOs;

use App\Http\Requests\RegisterExamRequest;
use Illuminate\Http\Request;

class PackageDto
{
    public string $name;
    public ?string $observations;
    public array $exam_ids;

    public function __construct(string $name, ?string $observations, array $exam_ids)
    {
        $this->name = $name;
        $this->observations = $observations;
        $this->exam_ids = $exam_ids;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('name'),
            $request->input('observations'),
            $request->input('exam_ids', [])
        );
    }
}
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

