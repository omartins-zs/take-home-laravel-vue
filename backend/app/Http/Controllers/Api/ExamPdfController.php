<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamPdfService;
use App\Repositories\Contracts\ExamRepositoryInterface;

class ExamPdfController extends Controller
{
    public function __construct(
        protected ExamPdfService         $examPdfService,
        protected ExamRepositoryInterface $examRepo
    ) {}

    public function generate(Request $request)
    {
        if ($request->filled('avulsos')) {
            $exams = $this->examRepo->getAvulsos();
            $groups = [[
                'title'      => 'Exames Avulsos',
                'printGroup' => 'Exames Avulsos',
                'exams'      => $exams->map(fn($e) => [
                    'name'       => $e->name,
                    'laterality' => $e->laterality,
                    'comment'    => $e->comment,
                    'groupPrint' => $e->group,
                ])->toArray(),
                'observation' => '',
            ]];
        } else {
            $groups = $request->input('groups', []);
        }

        if (empty($groups)) {
            return response()->json(['error' => 'Nenhum grupo informado'], 422);
        }

        $pdfUrl = $this->examPdfService->generate($groups);

        return response()->json(['pdf_url' => $pdfUrl]);
    }
}
