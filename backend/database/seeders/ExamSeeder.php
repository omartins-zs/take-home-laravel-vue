<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = [
            ['name' => 'Acuidade Visual AO', 'laterality' => 'AO', 'comment' => 'Teste de nitidez visual em ambos olhos', 'group' => 'Grupo 1'],
            ['name' => 'Refração OD', 'laterality' => 'OD', 'comment' => 'Determinação de grau de miopia/hipermetropia no olho direito', 'group' => 'Grupo 1'],
            ['name' => 'Refração OE', 'laterality' => 'OE', 'comment' => 'Determinação de grau de miopia/hipermetropia no olho esquerdo', 'group' => 'Grupo 1'],
            ['name' => 'Pressão Intraocular OD', 'laterality' => 'OD', 'comment' => 'Tonômetro de sopro no olho direito', 'group' => 'Grupo 2'],
            ['name' => 'Pressão Intraocular OE', 'laterality' => 'OE', 'comment' => 'Tonômetro de sopro no olho esquerdo', 'group' => 'Grupo 2'],
            ['name' => 'Topografia Corneana OD', 'laterality' => 'OD', 'comment' => 'Mapa tridimensional da córnea do olho direito', 'group' => 'Grupo 3'],
            ['name' => 'Topografia Corneana OE', 'laterality' => 'OE', 'comment' => 'Mapa tridimensional da córnea do olho esquerdo', 'group' => 'Grupo 3'],
            ['name' => 'Fotografia de Fundo de Olho AO', 'laterality' => 'AO', 'comment' => 'Registro de retina e nervo óptico em ambos olhos', 'group' => 'Grupo 4'],
        ];

        DB::table('exams')->insert(
            collect($exams)
                ->map(fn($exam) => array_merge(
                    $exam,
                    ['created_at' => now(), 'updated_at' => now()]
                ))
                ->toArray()
        );
    }
}
