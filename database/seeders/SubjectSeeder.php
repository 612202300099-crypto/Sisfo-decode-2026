<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = StudyProgram::all();

        if ($programs->isEmpty()) {
            return;
        }

        $subjects = [
            ['name' => 'Pemrograman Web', 'code' => 'PW101', 'study_program_id' => $programs->where('code', 'TI')->first()->id ?? $programs->random()->id],
            ['name' => 'Basis Data', 'code' => 'BD102', 'study_program_id' => $programs->where('code', 'SI')->first()->id ?? $programs->random()->id],
            ['name' => 'Algoritma & Struktur Data', 'code' => 'ASD103', 'study_program_id' => $programs->where('code', 'SI')->first()->id ?? $programs->random()->id],
            ['name' => 'Matematika Diskrit', 'code' => 'MD104', 'study_program_id' => $programs->random()->id],
            ['name' => 'Jaringan Komputer', 'code' => 'JK105', 'study_program_id' => $programs->random()->id],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(['code' => $subject['code']], $subject);
        }
    }
}
