<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            ['name' => 'Check-up Básico',       'observations' => 'Inclui acuidade visual e refração'],
            ['name' => 'Avaliação Glaucoma',    'observations' => 'Inclui pressão intraocular OD e OE'],
            ['name' => 'Mapa de Córnea Completo','observations' => 'Topografia OD e OE'],
            ['name' => 'Exame de Retina',       'observations' => 'Fotografia de fundo de olho'],
        ];

        $packageIds = [];
        foreach ($packages as $pkg) {
            $packageIds[] = DB::table('packages')->insertGetId(
                array_merge(
                    $pkg,
                    ['created_at' => now(), 'updated_at' => now()]
                )
            );
        }

        // Relações sem timestamps no pivot
        $relations = [
            // Check-up Básico
            ['package_id' => $packageIds[0], 'exam_id' => 1],
            ['package_id' => $packageIds[0], 'exam_id' => 2],
            ['package_id' => $packageIds[0], 'exam_id' => 3],

            // Avaliação Glaucoma
            ['package_id' => $packageIds[1], 'exam_id' => 4],
            ['package_id' => $packageIds[1], 'exam_id' => 5],

            // Mapa de Córnea Completo
            ['package_id' => $packageIds[2], 'exam_id' => 6],
            ['package_id' => $packageIds[2], 'exam_id' => 7],

            // Exame de Retina
            ['package_id' => $packageIds[3], 'exam_id' => 8],
        ];

        DB::table('exam_package')->insert($relations);
    }
}
