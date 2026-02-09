<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class SystemDataService
{
    /**
     * Get dashboard summary statistics
     */
    public function getDashboardStats(): array
    {
        return [
            'studyProgramCount' => StudyProgram::count(),
            'studentCount' => Student::count(),
            'subjectCount' => Subject::count(),
            'studentsPerProgram' => $this->getStudentsPerProgram(),
            'latestStudents' => Student::with('studyProgram')->latest()->take(5)->get(),
        ];
    }

    /**
     * Get distribution of students per study program for charts
     */
    private function getStudentsPerProgram(): array
    {
        return StudyProgram::withCount('students')
            ->get()
            ->map(fn($sp) => [
                'name' => $sp->name,
                'count' => $sp->students_count
            ])
            ->toArray();
    }
}
