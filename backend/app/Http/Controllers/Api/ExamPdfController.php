<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamPdfService;
use App\Repositories\Contracts\ExamRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\Response;

class ExamPdfController extends Controller
{
    public function __construct(
        protected ExamPdfService         $examPdfService,
        protected ExamRepositoryInterface $examRepo
    ) {}

    public function download(Request $request): Response
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

            if (is_string($groups)) {
                $groups = json_decode($groups, true) ?: [];
            }
        }

        if (empty($groups)) {
            return response()->json(['error' => 'Nenhum grupo informado'], 422);
        }

        $mocks = $this->examPdfService->getMocks();

        $pdf = Pdf::loadView('pdf.exam-request', [
            'groups'        => $groups,
            'doctor'        => $mocks['doctor'],
            'patient'       => $mocks['patient'],
            'separatePages' => collect($groups)->pluck('printGroup')->unique()->count() > 1,
        ])->setPaper('a4');

        return $pdf->download('solicitacao_exames_' . now()->format('Ymd_His') . '.pdf');
    }
}
