<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            ['code' => 'TI', 'name' => 'Teknik Informatika'],
            ['code' => 'SI', 'name' => 'Sistem Informasi'],
            ['code' => 'IF', 'name' => 'Informatika'],
            ['code' => 'TE', 'name' => 'Teknik Elektro'],
            ['code' => 'TM', 'name' => 'Teknik Mesin'],
        ];

        foreach ($programs as $program) {
            StudyProgram::create($program);
        }
    }
}
