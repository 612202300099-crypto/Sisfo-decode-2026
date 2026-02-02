<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
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

        $students = [
            ['name' => 'Budi Santoso', 'nim' => '20260001', 'study_program_id' => $programs->random()->id],
            ['name' => 'Siti Aminah', 'nim' => '20260002', 'study_program_id' => $programs->random()->id],
            ['name' => 'Agus Setiawan', 'nim' => '20260003', 'study_program_id' => $programs->random()->id],
            ['name' => 'Dewi Lestari', 'nim' => '20260004', 'study_program_id' => $programs->random()->id],
            ['name' => 'Lutfi Hakim', 'nim' => '20260005', 'study_program_id' => $programs->random()->id],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
