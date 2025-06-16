<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamPdfService;

class ExamPdfController extends Controller
{
    protected ExamPdfService $examPdfService;

    public function __construct(ExamPdfService $examPdfService)
    {
        $this->examPdfService = $examPdfService;
    }

    public function generate(Request $request)
    {
        $groups = $request->input('groups', []);

        if (empty($groups)) {
            return response()->json(['error' => 'Nenhum grupo informado'], 422);
        }

        $pdfUrl = $this->examPdfService->generate($groups);

        return response()->json(['pdf_url' => $pdfUrl]);
    }
}
