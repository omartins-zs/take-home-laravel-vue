<?php

namespace App\Http\Controllers\Api;

use App\Actions\Exam\RegisterExamAction;
use App\DTOs\ExamDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterExamRequest;
use App\Repositories\Contracts\ExamRepositoryInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(ExamRepositoryInterface $repo)
    {
        return response()->json($repo->paginate());
    }

    public function store(RegisterExamRequest $request, RegisterExamAction $action)
    {
        $dto = ExamDto::fromRequest($request);
        $exam = $action->execute($dto);
        return response()->json($exam, 201);
    }
}
