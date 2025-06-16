<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;


class ExamPdfService
{
    public function generate(array $groups): string
    {
        $printGroups = collect($groups)->pluck('printGroup')->unique();

        $doctor = [
            'name' => 'Dr. João da Silva',
            'crm' => 'CRM 12345',
        ];

        $patient = [
            'name' => 'Maria de Souza',
            'birth_date' => '1990-05-10',
            'gender' => 'Feminino',
        ];

        $data = [
            'groups' => $groups,
            'doctor' => $doctor,
            'patient' => $patient,
            'separatePages' => $printGroups->count() > 1,
        ];

        $pdf = Pdf::loadView('pdf.exam-request', $data)->setPaper('a4');

        $filename = 'exames_' . time() . '.pdf';
        $path = storage_path("app/public/{$filename}");
        $pdf->save($path);

        return asset("storage/{$filename}");
    }
}
