<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'name' => 'João da Silva',
            'cpf' => '123.456.789-00',
            'birth_date' => '1985-08-15',
            'gender' => 'Masculino',
        ]);
        Patient::create([
            'name' => 'Gabriel Matheus',
            'cpf' => '123.456.789-10',
            'birth_date' => '2004-04-06',
            'gender' => 'Masculino',
        ]);
    }
}
